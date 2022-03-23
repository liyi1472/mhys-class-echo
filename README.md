# 美和易思课堂回音系统

让老师听见学生的声音。



## 部署方法

1. 复制 `admin1.php` ，文件名末尾数字为班号。

2. 编辑刚复制的 `admin*.php` 文件，将其中的：

   ```php
   $studentsStr = '常贺凇,杜程,……';
   ```

   替换为任课教师班上的学生。

3. 将全部的 `.php` 文件和 `logs` 文件夹上传到 PHP 服务器。

   给 `logs` 文件夹赋 `chmod -R 777 logs` 权限。

4. 在 Nginx 的配置文件中设置教师端的基础认证。重启 Nginx 服务器。

   ```shell
   htpasswd -c /opt/tomato/nginx/config/.htpasswd admin
   ```

   ```nginx
   location ~* /mhys/admin\d+\.php {
       fastcgi_pass php:9000;
       fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
       include fastcgi_params;
       auth_basic "Please input username and password:";
       auth_basic_user_file /etc/nginx/conf.d/.htpasswd;
   }
   ```

5. 基础认证密码备注：`admin` **H\*** 。



## 使用方法

1. **学生访问学生端地址。**

   正确填写学生姓名。

   根据老师提问，点击对应按钮，提交学生反馈。

2. **教师访问教师端地址。**

   提问前点击“重新提问”按钮以清空历史信息。

   学生提交完毕后，点击“查看结果”按钮确认。

   - “查看结果”按钮旁数字代表未提交反馈人数。
   - 信号灯显示各反馈项出现次数的汇总。
   - 下方学生姓名显示颜色对应学生反馈内容。