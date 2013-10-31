To create a tar.gz for distrbuting, run the commands:

$ cd /path/to/git/repository/core-plugin/OJS

$ tar -zcvf  corePlugin.tar.gz --exclude='README.txt' --exclude='corePlugin.tar.gz' .

Ignore the error:
	'tar: .: file changed as we read it'

Thats is caused because we create the tar.gz in ./

NOTES:

version.xml needs to be in the root of the tar
Also in the root needs to be the folder containing all the plugin files. 

The name of the folder and the tar.gz needs to be the same in the <application> tag in version.xml