import pymysql
import pandas as pd
import plotly.express as px
import plotly.graph_objects as go

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

y = df.groupby('khoa')['maSV'].value_counts()
fig = px.bar(df, x = 'khoa', y = y)
fig.write_html("test.php")

fig2 = px.pie(df, 'khoa')
fig2.write_html("test2.php")
connection.close()