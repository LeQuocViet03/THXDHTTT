import pymysql
import pandas as pd
import plotly.express as px
import plotly.graph_objects as go

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

# Đọc dữ liệu từ bảng lsbaocao
query = "SELECT * FROM lsbaocao"
df_lsbaocao = pd.read_sql(query, connection)

# Đảm bảo `thoiGian` được chuyển đúng định dạng và trích xuất Tháng, Năm
df_lsbaocao['thoiGian'] = pd.to_datetime(df_lsbaocao['thoiGian'], errors='coerce')
df_lsbaocao['Tháng'] = df_lsbaocao['thoiGian'].dt.month
df_lsbaocao['Năm'] = df_lsbaocao['thoiGian'].dt.year.astype(int)

# Tính số lượng `maPhong` khác nhau theo Tháng và Năm
monthly_room_count = (
    df_lsbaocao.groupby(['Năm', 'Tháng'])['maPhong']
    .count()
    .reset_index(name='Số Lượng Phòng')  # Gộp rename vào reset_index
)

# Tạo biểu đồ line
fig = px.line(
    monthly_room_count,
    x='Tháng',
    y='Số Lượng Phòng',
    color='Năm',
    labels={'Tháng': 'Tháng', 'Số Lượng Phòng': 'Số Lượng Phòng', 'Năm': 'Năm'},
    markers=True  # Hiển thị các điểm trên đường
)

# Lưu biểu đồ
fig.write_html("line_chart_lsbaocao.html")

# Đếm số lần xuất hiện của mỗi phòng (maPhong)
dem_dong = df_lsbaocao['maPhong'].value_counts().reset_index()
dem_dong.columns = ['maPhong', 'Count']

# Tạo treemap
fig3 = px.treemap(
    dem_dong,
    path=['maPhong'],  # Dùng cột maPhong cho path
    values='Count',    # Dùng cột Count để biểu diễn kích thước
)

# Lưu treemap thành file HTML
fig3.write_html("treemaps_lsbaocao.html")

# Đóng kết nối
connection.close()
print("Kết nối đã được đóng.")