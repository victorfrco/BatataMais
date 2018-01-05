Set WshShell = CreateObject("WScript.Shell" ) 
WshShell.Run """C:\xampp\mysql\bin\mysqld.exe"" --defaults-file=C:\xampp\mysql\bin\my.ini --standalone --console", 0 
Set WshShell = Nothing