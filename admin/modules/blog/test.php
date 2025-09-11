import requests

url = "https://632336cd4c57.ngrok-free.app/web_new/tintuc_test/admin/modules/blog/xuly.php"

data = {
    "article_author": "Admin",
    "article_title": "Bài viết test từ Python",
    "article_summary": "Đây là tóm tắt bài viết",
    "article_content": "Nội dung chi tiết...",
    "article_tag": "test,python",
    "article_status": "published",
    "api": True  # quan trọng để chạy ở mode API
}

res = requests.post(url, json=data)  # gửi JSON
print(res.status_code)
print(res.json())