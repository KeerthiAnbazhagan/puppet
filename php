class php1::pack inherits gcc::gccpack{  

file{"/opt/software/auto.tar.gz":
      #  path=>'/opt/software/$php',
        source=>"puppet:///modules/php1/auto.tar.gz",
        ensure=>'present',
}->

exec{"untar1":
#	source=>"puppet:///modules/php1/auto.tar.gz",
	 command=>"tar -xzf auto.tar.gz",
	path=>['/bin','/sbin','/usr/bin','/usr','/usr/sbin'],
	require=>File["/opt/software/auto.tar.gz"],

} ->
	
exec{"install007":
        command=>"yum localinstall *.rpm -y",
        cwd=>'/opt/software/auto/',
	path=>['/bin','/sbin','/usr/bin','/usr','/usr/sbin'],
        timeout=>1800,
	require=>Exec['untar'],
} 


file{"/opt/software/php-7.0.5.tar.gz":
      #  path=>'/opt/software/$php',
        source=>"puppet:///modules/php1/php-7.0.5.tar.gz",
        ensure=>'present',
       #	path=>['/bin','/sbin','/usr/bin','/usr','/usr/sbin']
	require=>File["/opt/software/auto.tar.gz"],

}  ->

exec{"untar":
	path=>['/bin','/sbin','/usr/bin','/usr','/usr/sbin'],
	cwd=>'/opt/software/',
     command=>"tar -xvzf php-7.0.5.tar.gz",

                
}->

exec{"installation":
        cwd=>"/opt/software/php-7.0.5/",
        command=>"/opt/software/php-7.0.5/buildconf --force",
	path=>['/bin','/sbin','/usr/bin','/usr','/usr/sbin'],
        timeout=>1800,
	require=>Exec['untar1'],
}->

exec{"installation1":
	path=>['/bin','/sbin','/usr/bin','/usr','/usr/sbin'],
	cwd=>'/opt/software/php-7.0.5/',
        command=>"/opt/software/php-7.0.5/configure",
        timeout=>1800,
}->

exec{"installation2":
	path=>['/bin','/sbin','/usr/bin','/usr','/usr/sbin'],
	cwd=>'/opt/software/php-7.0.5/',
        command=>"make",
        timeout=>1800,
}->

exec{"installation3":
	path=>['/bin','/sbin','/usr/bin','/usr','/usr/sbin'],
	cwd=>'/opt/software/php-7.0.5/',
        command=>"make install",
        timeout=>1800,
}

}

