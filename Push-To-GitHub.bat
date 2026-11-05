@echo off
title Day Ma Nguon Len GitHub De Render Cap Nhat
color 0B
echo =========================================================
echo   DANG DAY MA NGUON LEN GITHUB (RENDER AUTO DEPLOY)
echo =========================================================
echo.

cd /d "%~dp0"

set "GIT_CMD=C:\laragon\bin\git\bin\git.exe"
if not exist "%GIT_CMD%" (
    set "GIT_CMD=git"
)

echo [1/3] Kiem tra trang thai Git...
"%GIT_CMD%" status

echo.
echo [2/3] Them tat ca thay doi va commit...
"%GIT_CMD%" add .
"%GIT_CMD%" commit -m "feat: update student tutor page and availability flow"

echo.
echo [3/3] Dang day len GitHub (origin main)...
"%GIT_CMD%" push origin main

echo.
echo =========================================================
if %ERRORLEVEL% EQU 0 (
    echo [THANH CONG] Da day ma nguon len GitHub thanh cong!
    echo Render se tu dong phat hien va cap nhat website sau 2-3 phut.
    echo Website Render: https://gia-su-website.onrender.com/
) else (
    echo [CHU Y] Co the can dang nhap GitHub trong cua so hien len.
)
echo =========================================================
echo.
pause
