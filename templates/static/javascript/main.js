function toggleChapter() {
    const chapter = document.getElementById('chapter');
    if (chapter.style.display === "none") {
        chapter.style.display = "block";
    } else {
        chapter.style.display = "none"
    }
}

document.querySelector(".button-toggle").addEventListener("click", function () {
    document.querySelector(".container").classList.toggle("hide-chapter");
    document.querySelector(".chapter").classList.toggle("hidden");
});
