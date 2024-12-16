import pymysql
import pandas as pd
import plotly.express as px
import plotly.graph_objects as go
from plotly.subplots import make_subplots
import numpy as np

# Kết nối tới MySQL với việc xử lý lỗi
try:
    connection = pymysql.connect(
        host="localhost",
        user="root",
        password="",
        database="QLPHONGTHUCHANH",
        port=3307
    )
    print("Kết nối thành công!")
except pymysql.MySQLError as e:
    print(f"Lỗi kết nối: {e}")
    exit()

# Đọc dữ liệu từ bảng sinhvien
query = "SELECT * FROM sinhvien"
df_sinhvien = pd.read_sql(query, connection)

# Kiểm tra xem dữ liệu đã được tải thành công chưa
if df_sinhvien.empty:
    print("Dữ liệu không có sẵn trong bảng sinhvien.")
    connection.close()
    exit()

# Nhóm dữ liệu theo 'khoa' và 'khoaHoc', sau đó đếm số lượng sinh viên trong mỗi nhóm
grouped = df_sinhvien.groupby(['khoa', 'khoaHoc']).agg(
    maSV_count=('maSV', 'count')
).reset_index()

# Tạo biểu đồ cột với 'khoaHoc' làm màu sắc
fig = px.bar(
    grouped,
    x='khoa',
    y='maSV_count',
    color='khoaHoc',  # Dùng 'khoaHoc' làm màu
    labels={'khoa': 'Khoa', 'maSV_count': 'Số lượng sinh viên', 'khoaHoc': 'Khóa học'}
)

fig.update_layout(barmode='group')

# Lưu biểu đồ thành file HTML
fig.write_html("bar_chart.html")


# Biểu đồ tròn: Tỷ lệ sinh viên theo khoa
fig2 = px.pie(df_sinhvien, names='khoa')
fig2.write_html("pie_chart.html")

# Đóng kết nối tự động khi kết thúc khối lệnh
connection.close()
print("Kết nối đã được đóng.")
