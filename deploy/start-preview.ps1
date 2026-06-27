<#
  Starts the site as a public preview on http://YOUR_VPS_IP:8000
  Run ON the VPS, from the project folder, after vps-setup.ps1 has completed.
#>
$ErrorActionPreference = "Stop"
$root = Split-Path -Parent $PSScriptRoot
Set-Location $root

function Find-Php {
    $cmd = Get-Command php -ErrorAction SilentlyContinue
    if ($cmd) { return $cmd.Source }
    foreach ($c in @("C:\xampp\php\php.exe","C:\php\php.exe","C:\php83\php.exe")) { if (Test-Path $c) { return $c } }
    return $null
}
$php = Find-Php
if (-not $php) { Write-Host "PHP not found. Run deploy\vps-setup.ps1 first." -ForegroundColor Red; exit 1 }

# Open the firewall port (idempotent)
if (-not (Get-NetFirewallRule -DisplayName "Laravel Preview 8000" -ErrorAction SilentlyContinue)) {
    New-NetFirewallRule -DisplayName "Laravel Preview 8000" -Direction Inbound -Protocol TCP -LocalPort 8000 -Action Allow | Out-Null
    Write-Host "Opened Windows Firewall TCP 8000." -ForegroundColor Green
}

$ip = (Invoke-RestMethod -Uri "https://api.ipify.org" -ErrorAction SilentlyContinue)
Write-Host "Starting preview server..." -ForegroundColor Cyan
if ($ip) { Write-Host "Share this with the client:  http://$ip`:8000" -ForegroundColor Yellow }
Write-Host "(Keep this window open. For 24/7, run it as a service with NSSM - see DEPLOY.md.)`n"

& $php artisan serve --host=0.0.0.0 --port=8000
