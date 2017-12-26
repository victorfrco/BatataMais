Set WshShell = CreateObject("WScript.Shell" ) 
WshShell.Run chr(34) & "C:\xampp\apache\bin\httpd.exe" & Chr(34), 0 
Set WshShell = Nothing