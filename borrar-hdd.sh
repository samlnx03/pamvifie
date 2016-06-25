#!/bin/bash
NAME=$1
if [ -z "$NAME" ]; then
	echo "-1 no se paso argumento 1 nombre"
	exit
fi

exec 2>/dev/null

#sperez@fiesrv:~/pamvifie$ sudo lvcreate -L 6G -n MOI5 fie_vg
#  Logical volume "MOI5" already exists in volume group "fie_vg"
#sperez@fiesrv:~/pamvifie$ sudo lvcreate -L 100M -n borrame fie_vg
#  Logical volume "borrame" created
#sperez@fiesrv:~/pamvifie$ sudo lvremove -f fie_vg/borrame1
#  Logical volume "borrame1" successfully removed

S=$(lvremove -f fie_vg/$NAME)
echo "$S"
