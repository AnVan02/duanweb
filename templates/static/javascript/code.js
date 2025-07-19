
document.querySelectorAll('.button button[id^="copyButton"]').forEach(button => {
    button.addEventListener('click', function () {
        const codeId = this.id.replace('copyButton', 'codeContent');
        const codeBlocks = document.querySelectorAll(`[id="${codeId}"]`);
        let textToCopy = "";

        codeBlocks.forEach(block => {
            textToCopy += block.innerText + "\n";
        });

        navigator.clipboard.writeText(textToCopy).then(() => {
            // alert("Đã sao chép đoạn code!");
        }).catch(err => {
            alert("Không thể sao chép, hãy thử lại!");
        });
    });
});

document.querySelectorAll('.button button[id^="runButton"]').forEach(button => {
    button.addEventListener('click', function () {
        const buttonId = this.id;
        const codeId = buttonId.replace("runButton", "codeContent");
        const outputId = buttonId.replace("runButton", "output");

        runCode(codeId, outputId);
    });
});

function runCode(codeContentId, outputId) {
    const codeBlocks = document.querySelectorAll(`[id="${codeContentId}"]`);
    let codeText = "";

    codeBlocks.forEach(block => {
        codeText += block.innerText + "\n";
    });

    fetch("https://emkc.org/api/v2/piston/execute", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ language: "python", version: "3.10.0", files: [{ content: codeText }] })
    })
        .then(response => response.json())
        .then(data => {
            document.getElementById(outputId).innerText = data.run.output || "Lỗi khi chạy code";
        })
        .catch(() => {
            document.getElementById(outputId).innerText = "Không thể chạy code!";
        });
}
