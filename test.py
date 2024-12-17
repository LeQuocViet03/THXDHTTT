import pymysql
import pandas as pd
import plotly.express as px

# Kết nối tới MySQL
connection = pymysql.connect(
    host="localhost",
    user="root",
    password="",
    database="QLPHONGTHUCHANH",
    port=3307
)

query = ("SELECT * FROM sinhvien")
df = pd.read_sql(query, connection)

fig = px.bar(df, 'khoa')
fig.write_html("test.php")

# fig2 = px.pie(df, 'khoa')
# fig2.write_html("test2.html")
# connection.close()