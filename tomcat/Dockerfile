# === 使用 Tomcat 10 官方內建的 legacy 自動轉譯功能 ===
#FROM tomcat:10.0-jdk11-openjdk
FROM tomcat:9.0-jdk8-openjdk

# 1. 清除預設的空根目錄
RUN rm -rf /usr/local/tomcat/webapps/ROOT

# 2. 【關鍵】把您原本「完全沒經過工具轉換」的原始舊專案 war 檔，
#    直接放到 webapps-javaee 目錄下並命名為 ROOT.war。
#COPY axe_point_system.war /usr/local/tomcat/webapps/ROOT.war

# 3. 放入您的 MySQL 8.0.30 驅動程式
COPY mysql-connector-java-8.0.30.jar /usr/local/tomcat/lib/

# 4. 覆蓋 Tomcat 設定，注入全域 Jakarta 規格的資料庫連線池
COPY context.xml /usr/local/tomcat/conf/context.xml

CMD ["catalina.sh", "run"]

