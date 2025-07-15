async function runPython() {
    const code = document.getElementById("codeInput").value;
    const outputDiv = document.getElementById("output");

    if (!code.trim()) {
        outputDiv.innerHTML = "Vui lòng nhập mã Python để chạy.";
        return;
    }

    outputDiv.innerHTML = "Đang chạy...";

    try {
        const response = await fetch("https://emkc.org/api/v2/piston/execute", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                language: "python",
                version: "3.10.0",
                files: [{ content: code }]
            })
        });

        const result = await response.json();
        const output = result.run.stdout || result.run.stderr || "⚠️ Không có đầu ra.";

        // Định dạng lại kết quả để hiển thị đúng theo dòng
        outputDiv.innerHTML = `<pre>${output}</pre>`;
    } catch (error) {
        outputDiv.innerHTML = `<pre>Lỗi: ${error.message}</pre>`;
    }
}
