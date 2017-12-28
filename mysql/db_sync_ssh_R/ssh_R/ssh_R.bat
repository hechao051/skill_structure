@echo off

set host=121.42.217.9
set port=22
set login=db_sync

set rl_ip=127.0.0.1
set rl_port=36101
set r_ip=127.0.0.1
set r_port=3308


C:\ssh_R\PLINK.EXE -C -N -R %rl_ip%:%rl_port%:%r_ip%:%r_port% -i C:\ssh_R\id_rsa.ppk -P %port% %login%@%host%


