import pymysql
import pandas as pd
import plotly.graph_objects as go

# Kết nối tới MySQL và xử lý lỗi
try:
    with pymysql.connect(
        host="localhost",
        user="root",
        password="",
        database="QLPHONGTHUCHANH",
        port=3307
    ) as connection:
        print("Kết nối thành công!")
        
        # Đọc dữ liệu từ bảng lssuachua
        query = "SELECT * FROM lssuachua"
        df_lssuachua = pd.read_sql_query(query, connection)
        
        # Trích xuất năm từ cột thoiGian và xác định thứ tự maPhong
        df_lssuachua['nam'] = pd.to_datetime(df_lssuachua['thoiGian']).dt.year
        phong_order = df_lssuachua['maPhong'].sort_values().unique()
        
        # Nhóm dữ liệu cho biểu đồ bar
        grouped_bar = (
            df_lssuachua.groupby(['maPhong', 'noiDung'])
            .size()
            .reset_index(name='soluong')
        )
        
        # Nhóm dữ liệu cho biểu đồ line theo năm và phòng
        grouped_line = (
            df_lssuachua.groupby(['nam', 'maPhong'])
            .size()
            .reset_index(name='soluong')
        )
        
        # Tạo biểu đồ bar
        bar_traces = [
            go.Bar(
                x=grouped_bar[grouped_bar['noiDung'] == noiDung]['maPhong'],
                y=grouped_bar[grouped_bar['noiDung'] == noiDung]['soluong'],
                name=f'Nội dung: {noiDung}'
            )
            for noiDung in grouped_bar['noiDung'].unique()
        ]
        
        # Tạo biểu đồ line
        line_traces = [
            go.Scatter(
                x=grouped_line[grouped_line['nam'] == nam]['maPhong'],
                y=grouped_line[grouped_line['nam'] == nam]['soluong'],
                mode='lines+markers',
                name=f'Năm {nam}'
            )
            for nam in grouped_line['nam'].unique()
        ]
        
        # Kết hợp biểu đồ bar và line
        fig = go.Figure(data=bar_traces + line_traces)
        fig.update_layout(
            xaxis_title="Mã Phòng",
            yaxis_title="Số Lượng",
            barmode='group',
            xaxis=dict(categoryorder='array', categoryarray=list(phong_order))
        )
        
        # Lưu biểu đồ thành file HTML
        fig.write_html("optimized_combined_lssuachua.html")
        print("Biểu đồ đã được lưu thành công!")
        
except pymysql.MySQLError as e:
    print(f"Lỗi kết nối: {e}")
