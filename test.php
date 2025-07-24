<style>
    /* RESET CƠ BẢN */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: "Segoe UI", sans-serif;
  font-size: 15px;
  background: #f7f7f7;
  color: #333;
  padding: 10px;
  line-height: 1.5;
}

/* TIÊU ĐỀ KHÓA HỌC */
.course-title {
  font-size: 1.25rem;
  font-weight: bold;
  margin-bottom: 5px;
}

/* MÔ TẢ NGẮN */
.course-description {
  font-size: 0.95rem;
  color: #666;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  margin-bottom: 15px;
}

/* BUTTON HÀNH ĐỘNG */
.btn {
  display: inline-block;
  width: 100%;
  background: #007bff;
  color: white;
  padding: 10px 12px;
  border: none;
  border-radius: 8px;
  font-size: 1rem;
  text-align: center;
  margin-top: 10px;
  cursor: pointer;
  transition: background 0.3s;
}
.btn:hover {
  background: #0056b3;
}

/* DANH SÁCH CHƯƠNG HỌC */
.chapter-list {
  margin-top: 20px;
}
.chapter {
  background: white;
  border-radius: 10px;
  padding: 12px 15px;
  margin-bottom: 15px;
  box-shadow: 0 1px 4px rgba(0,0,0,0.05);
}
.chapter p {
  margin-bottom: 5px;
}
.chapter .status {
  color: green;
  font-weight: bold;
  font-size: 0.9rem;
}

/* BẢNG DẠNG RESPONSIVE (CHUYỂN BLOCK) */
@media screen and (max-width: 480px) {
  table, thead, tbody, th, td, tr {
    display: block;
  }
  thead {
    display: none;
  }
  tr {
    margin-bottom: 15px;
    background: white;
    padding: 10px;
    border-radius: 8px;
    box-shadow: 0 1px 4px rgba(0,0,0,0.05);
  }
  td {
    position: relative;
    padding-left: 50%;
    padding-top: 10px;
    padding-bottom: 10px;
    font-size: 0.95rem;
    border-bottom: 1px solid #eee;
  }
  td:before {
    position: absolute;
    top: 10px;
    left: 10px;
    width: 45%;
    font-weight: bold;
    color: #555;
  }
  td:nth-of-type(1):before { content: "Tiến độ"; }
  td:nth-of-type(2):before { content: "Tên khóa học"; }
  td:nth-of-type(3):before { content: "Chương"; }
  td:nth-of-type(4):before { content: "Trạng thái"; }
  td:nth-of-type(5):before { content: "Hành động"; }
}

</style>