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

# Đọc dữ liệu từ bảng lsthaydoi
query = "SELECT * FROM lsthaydoi"
df_lsthaydoi = pd.read_sql(query, connection)

# Kiểm tra xem dữ liệu đã được tải thành công chưa
if df_lsthaydoi.empty:
    print("Dữ liệu không có sẵn trong bảng lsthaydoi.")
    connection.close()
    exit()

# # Tạo bảng đếm số lượng trùng giữa phongCu và phongMoi
# data_pivot = df_lsthaydoi.groupby(['phongCu', 'phongMoi']).size().reset_index(name='Count')

# # Tạo biểu đồ heatmap
# fig = px.density_heatmap(
#     data_pivot, 
#     x='phongCu', 
#     y='phongMoi', 
#     z='Count', 
#     color_continuous_scale='Viridis',
#     labels={'phongCu': 'Phòng Cũ', 'phongMoi': 'Phòng Mới', 'Count': 'Số lượng'},
#     title="Heatmap giữa Phòng Cũ và Phòng Mới"
# )

# fig.write_html("heatmap_lsthaydoi.html")


# Tạo bảng đếm số lượng trùng giữa caCu và caMoi
data_pivot2 = df_lsthaydoi.groupby(['caCu', 'caMoi']).size().reset_index(name='Count2')

# Tạo biểu đồ heatmap
fig2 = px.density_heatmap(
    data_pivot2, 
    x='caCu', 
    y='caMoi', 
    z='Count2', 
    color_continuous_scale='Viridis',
    labels={'caCu': 'Ca Cũ', 'caMoi': 'Ca Mới', 'Count2': 'Số lượng'},
)

fig2.write_html("heatmap2_lsthaydoi.html")

# Đóng kết nối tự động khi kết thúc khối lệnh
connection.close()
print("Kết nối đã được đóng.")
