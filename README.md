# AutoLogger

This script may be useful for console applications that do not support logging but 
outputs some important information in console (to STDOUT). And if you want to run 
these script periodically using Cron, you need AutoLogger to know how it was executed.

AutoLogger script works very simple: it takes their STDIN stream, wraps every line into
log format by adding date and time at the beginning and outputs this in STDOUT. Then
you can redirect this to your log file.

Suppose you have a PHP script which runs as follows:

```
php /path/to/somescript.php
```

...and this script outputs something in STDOUT and maybe in STDERR. You need to redirect
all output of this script to AutoLogger using pipelining syntax:

```
php /path/to/somescript.php 2>&1 | php /path/to/autologger.php >> /path/to/somescript.log
```

The fragment `2>&1` is used to combine STDERR and STDOUT. Without this only STDOUT will 
be logged. Some errors outputs in STDERR. For example "PHP Parse error: ..." messages 
outputs to STDERR stream.

## Installation

1. Create folder for Autologger and enter into it:
```
mkdir autologger
chdir autologger
```

2. Clone git repository:
```
git clone git@github.com:gugglegum/autologger.git . 
```

3. Copy example config to real:
```
cp config.example.php config.php
```

4. Edit config file (OPTIONAL):
```
nano config.php
```

That's is all. Now you can add logging to any console application by adding 
pipelining in execute command. Cron task (`crontab -e`) may looks as follows:

```
0 * * * * php /opt/my-project/price-updater.php 2>&1 | php /opt/autologger/autologger.php >> /var/log/price-updater.log 
```

## License

See the [LICENSE](LICENSE) file for license rights ~~and limitations~~ (Unlicense, public domain).

P.S. I know this is not very good approach to organize you logs, but in some cases there's
no other way (legacy scripts, binary executables without sources, as temporary 
solution until you add native logging support).
