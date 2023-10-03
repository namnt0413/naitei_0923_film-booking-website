const createCommentBtn = document.getElementById("createCommentBtn");
const editCommentBtn = document.getElementById("editCommentBtn");
const commentModal = document.getElementById("commentModal");
const commentModalEdit = document.getElementById("commentModalEdit");
const closeModal = document.getElementById("closeModal");
const closeModalEdit = document.getElementById("closeModalEdit");
const modalOverlay = document.querySelector(".modal-overlay");
const commentInput = document.getElementById("comment");
const commentInputEdit = document.getElementById("commentEdit");
const ratingInputs = document.querySelectorAll('[name="rating"]');

createCommentBtn.addEventListener("click", function () {
    commentModal.classList.remove("hidden");
    modalOverlay.classList.remove("hidden");

    commentInput.value = "";
    ratingInputs.forEach((input) => {
        input.checked = false;
    });
});

editCommentBtn.addEventListener("click", function () {
    commentModalEdit.classList.remove("hidden");
    modalOverlay.classList.remove("hidden");
    const comment = this.getAttribute("data-comment");
    const rating = this.getAttribute("data-rating");
    commentInputEdit.value = comment;
    ratingInputs.forEach((input) => {
        if (input.value === rating) {
            input.checked = true;
        }
    });
});

closeModal.addEventListener("click", function () {
    commentModal.classList.add("hidden");
    modalOverlay.classList.add("hidden");
});

closeModalEdit.addEventListener("click", function () {
    commentModalEdit.classList.add("hidden");
    modalOverlay.classList.add("hidden");
});
