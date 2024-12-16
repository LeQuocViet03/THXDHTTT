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
        port=3306
    )
    print("Kết nối thành công!")
except pymysql.MySQLError as e:
    print(f"Lỗi kết nối: {e}")
    exit()

# Đọc dữ liệu từ bảng hocphan
query = "SELECT * FROM hocphan"
df_hocphan = pd.read_sql(query, connection)

# Tính số lượng khoa khác nhau theo từng khoaHoc
df_count = df_hocphan.groupby(['khoaHoc', 'khoa']).size().reset_index(name='soLuongKhoa')

# Tạo biểu đồ dạng bar cho từng khoaHoc và số lượng khoa
bar_traces = [
    go.Bar(
        x=df_count[df_count['khoaHoc'] == khoaHoc]['khoa'],  # Các khoa của khoaHoc
        y=df_count[df_count['khoaHoc'] == khoaHoc]['soLuongKhoa'],  # Số lượng khoa
        name=f'KhoaHoc: {khoaHoc}'  # Tên của từng khoaHoc
    )
    for khoaHoc in df_count['khoaHoc'].unique()  # Lặp qua từng khoaHoc
]

# Tạo layout cho biểu đồ
layout = go.Layout(
    barmode='group',
    title="Số Lượng Lớp Theo Khóa Học",
    xaxis=dict(title='Khoa'),
    yaxis=dict(title='Số Lượng Lớp'),
    legend_title="Khóa Học"
)

# Vẽ biểu đồ
fig = go.Figure(data=bar_traces, layout=layout)

# Hiển thị biểu đồ
fig.write_html("bar_hocphan.html")

# Đóng kết nối tự động khi kết thúc khối lệnh
connection.close()
print("Kết nối đã được đóng.")
