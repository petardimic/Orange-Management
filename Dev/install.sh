MUSER="root"
MPASS="s4b3r?"
MDB="orange_management"

# Detect paths
MYSQL=$(which mysql)
AWK=$(which awk)
GREP=$(which grep)

TABLES=$($MYSQL -u $MUSER -p$MPASS $MDB -e 'show tables' | $AWK '{ print $1}' | $GREP -v '^Tables' )
 
for t in $TABLES
do
	$MYSQL -u $MUSER -p$MPASS $MDB -e "SET FOREIGN_KEY_CHECKS = 0;drop table $t"
done

wget -O - -q -t 1 "http://127.0.0.1/Admin/Install/index.php" > /dev/null 2>&1
curl -H "Content-Type: application/json; charset=utf-8" -X PUT -d "{\"id\": \"Controlling\"}" http://127.0.0.1/en/api/admin/module.php

echo "Project installed!!!!!"