window.addEventListener("DOMContentLoaded", () => {
  const modal = document.querySelector("#confirmation-modal");
  const modalTitle = document.querySelector("#modal-title");
  const modalText1 = document.querySelector("#modal-text-1");
  const modalText2 = document.querySelector("#modal-text-2");
  const modalConfirm = document.querySelector("#modal-confirm");
  const modalCancel = document.querySelector("#modal-cancel");

  const editButton = document.querySelector("#edit-story");
  const deleteButton = document.querySelector("#delete-story");

  const modalContent = {
    edit: {
      title: "Edit Confirmation",
      text1: "Are you sure you want to edit this story?",
      text2:
        "Any changes you make will update the current version of the story.",
      href: editURL,
    },

    delete: {
      title: "Delete Confirmation",
      text1: "Are you sure you want to delete this story?",
      text2:
        "This action cannot be undone, and all of the story's content will be permanently removed.",
      href: deleteURL,
    },
  };

  const openModal = (type) => {
    const content = modalContent[type];

    modalTitle.textContent = content.title;
    modalText1.textContent = content.text1;
    modalText2.textContent = content.text2;
    modalConfirm.href = content.href;

    modal.classList.remove("hidden");
    modal.classList.add("flex");
  };

  const closeModal = () => {
    modal.classList.add("hidden");
    modal.classList.remove("flex");
  };

  editButton.addEventListener("click", () => openModal("edit"));
  deleteButton.addEventListener("click", () => openModal("delete"));

  modalCancel.addEventListener("click", () => closeModal());

  modal.addEventListener("click", (e) => {
    if (e.target === modal) closeModal();
  });
});
