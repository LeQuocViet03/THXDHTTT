import pymysql
import pandas as pd
import plotly.express as px

# Kết nối tới MySQL với việc xử lý lỗi
try:
    connection = pymysql.connect(
        host="localhost",
        user="root",
        password="",
        database="QLPHONGTHUCHANH",
        port=3306
    )
    print("Kết nối thành công!")
except pymysql.MySQLError as e:
    print(f"Lỗi kết nối: {e}")
    exit()

# Đọc dữ liệu từ bảng phancong
query = "SELECT * FROM phancong"
df_phancong = pd.read_sql(query, connection)

# Đọc dữ liệu từ bảng giangvien
query_giangvien = "SELECT * FROM giangvien"
df_giangvien = pd.read_sql(query_giangvien, connection)

# Kiểm tra xem dữ liệu đã được tải thành công chưa
if df_phancong.empty or df_giangvien.empty:
    print("Dữ liệu không có sẵn trong bảng phancong hoặc giangvien.")
    connection.close()
    exit()

# Kết nối hai bảng theo maGV
df_merged = pd.merge(df_phancong, df_giangvien[['maGV', 'hoTen']], on='maGV', how='inner')

# Gom các mã ca học (maCH) thành danh sách cho mỗi cặp (hoTen, maPhong)
df_count = df_merged.groupby(['hoTen', 'maPhong']) \
    .agg(maCH_list=('maCH', lambda x: ', '.join(map(str, x))),  # Gộp các mã ca học thành chuỗi
         maCH_count=('maCH', 'count')) \
    .reset_index()

# Vẽ biểu đồ phân tán với size là số lượng mã ca học và hover_data hiển thị danh sách mã ca học
fig = px.scatter(
    df_count, 
    x='hoTen',  # Trục x là họ tên giảng viên
    y='maPhong',  # Trục y là mã phòng
    size='maCH_count',  # Kích thước điểm là số lượng mã ca học
    color='maPhong',  # Mỗi mã phòng sẽ có màu riêng biệt
    hover_data={'maCH_list': True, 'maCH_count': True},  # Hiển thị danh sách mã ca học và số lượng
    labels={
        'hoTen': 'Họ Tên Giáo Viên',
        'maPhong': 'Mã Phòng',
        'maCH_count': 'Số Lượng Mã Ca Học',
        'maCH_list': 'Danh Sách Mã Ca Học'
    },
    title="Biểu Đồ Phân Tán Số Lượng Và Danh Sách Mã Ca Học Theo Mã Phòng Và Giáo Viên",
)

# Hiển thị biểu đồ
fig.write_html("scatter_hoTen_maCH_maPhong_hover.html")

# Đóng kết nối tự động khi kết thúc khối lệnh
connection.close()
print("Kết nối đã được đóng.")
