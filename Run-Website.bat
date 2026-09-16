@echo off
title Webside Ket Noi Trung Tam Gia Su - Local Server
color 0A
echo ===================================================
echo   DANG KHOI DONG WEBSITE KET NOI TRUNG TAM GIA SU
echo ===================================================
echo.
echo Website dang chay tai dia chi: http://localhost:8000
echo Trang Dang Nhap: http://localhost:8000/login
echo.
echo (De giu website hoat dong, vui long KHONG tat cua so nay)
echo ===================================================
echo.

cd /d "C:\Users\daoph\.gemini\antigravity\scratch\gia-su-website"
"C:\Users\daoph\php\php.exe" artisan serve --host=127.0.0.1 --port=8000

pause
