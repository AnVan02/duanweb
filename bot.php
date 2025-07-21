<style>
    .chatbot-popup {
        display: none;
        position: fixed;
        bottom: 10px;
        right: 10px;
        width: 480px;
        height: 95vh;
        border: 1px solid #ccc;
        background: #fff;
        z-index: 10000;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
        border-radius: 8px;
        overflow: hidden;
    }

    @media (max-width: 1024px) {
        .chatbot-popup {
            width: 95vw;
            height: 85vh;
            right: 2.5vw;
            bottom: 2vh;
            border-radius: 10px;
        }
    }

    @media (max-width: 768px) {
        .chatbot-popup {
            width: 95vw;
            height: 80vh;
            right: 2.5vw;
            bottom: 2vh;
            border-radius: 12px;
        }
    }

    @media (max-width: 480px) {
        .chatbot-popup {
            width: 98vw;
            height: 75vh;
            right: 1vw;
            bottom: 1vh;
            border-radius: 14px;
        }
    }

    @media (max-height: 400px) {
        .chatbot-popup {
            height: 70vh;
        }
    }
</style>



<div class="chatbot_main">
    <img src="https://longbinh.com.vn/images/companies/1/2025/icon-chatbox-AI/icon-chatbox-AI-chatbox_ai_long_binh.com.vn.png?1752140856841"
        width="60" height="60" style="cursor: pointer; position: fixed; right: 10px; bottom: 265px; z-index: 1000;"
        onclick="document.getElementById('chatbot-popup').style.display='block'" />
</div>

<!-- Khung chatbot popup -->
<div id="chatbot-popup">
    <!-- Header -->
    <div style="background: #eee; padding: 5px; text-align: right;">
        <button onclick="document.getElementById('chatbot-popup').style.display='none'"
            style="border: none; background: transparent; font-size: 16px;">✕</button>
    </div>

    <!-- Nội dung chatbot -->
    <iframe src="https://server1.rosachatbot.com/longbinh" width="100%" height="100%" style="border: none;"></iframe>
</div>
<!--  -->

<style>
    .chatbot-popup {
        display: none;
        position: fixed;
        bottom: 10px;
        right: 10px;
        width: 480px;
        height: 95vh;
        border: 1px solid #ccc;
        background: #fff;
        z-index: 10000;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
        border-radius: 8px;
        overflow: hidden;
        /* Thêm dòng này để flexbox */
        display: flex;
        flex-direction: column;
    }
    .chatbot-popup-header {
        background: #eee;
        padding: 5px;
        text-align: right;
        flex: 0 0 auto;
    }
    .chatbot-popup-iframe {
        flex: 1 1 auto;
        width: 100%;
        border: none;
    }
    /* ... các media query giữ nguyên ... */
</style>

<div class="chatbot_main">
    <img src="https://longbinh.com.vn/images/companies/1/2025/icon-chatbox-AI/icon-chatbox-AI-chatbox_ai_long_binh.com.vn.png?1752140856841"
        width="60" height="60"
        style="cursor: pointer; position: fixed; right: 10px; bottom: 20px; z-index: 10000;"
        onclick="document.getElementById('chatbot-popup').style.display='flex'" />
</div>

<div id="chatbot-popup" class="chatbot-popup">
    <div class="chatbot-popup-header">
        <button onclick="document.getElementById('chatbot-popup').style.display='none'"
            style="border: none; background: transparent; font-size: 16px;">✕</button>
    </div>
    <iframe class="chatbot-popup-iframe" src="https://server1.rosachatbot.com/longbinh"></iframe>
</div>