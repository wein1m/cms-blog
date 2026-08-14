window.addEventListener("DOMContentLoaded", () => {
  // initializing Quill editor
  const editor = document.querySelector("#editor");
  if (!editor) return;

  const quill = new Quill("#editor", {
    placeholder: "Enter your stories here",
    theme: "snow",
  });

  quill.root.innerHTML =
    typeof quillContent !== "undefined" ? quillContent : "";

  // Thumbnail live preview
  const imgInput = document.querySelector("#img_url");
  const imgContainer = document.querySelector("#img-container");

  let timeout;

  const updateImagePreview = (url) => {
    if (!url) {
      imgContainer.innerHTML = "";
      return;
    }

    const img = new Image();

    img.onload = () => {
      img.className = "mt-3 shadow-lg";
      imgContainer.innerHTML = "";
      imgContainer.appendChild(img);
    };

    img.onerror = () => {
      imgContainer.innerHTML = `
        <p class="mt-3 text-primary font-semibold">
          Unable to load image.
        </p>
      `;
    };
    img.src = url;
  };

  imgInput?.addEventListener("input", () => {
    clearTimeout(timeout);

    timeout = setTimeout(() => {
      updateImagePreview(imgInput.value.trim());
    }, 500);
  });

  // initial load preview (on edit form)
  if (imgInput?.value) {
    updateImagePreview(imgInput.value.trim());
  }

  // category selection
  const categories = document.querySelectorAll(".category");
  const categoryInput = document.querySelector("#category-input");
  let selectedCategory = categoryInput?.value || null;

  categories.forEach((cat) => {
    const catId = cat.dataset.catId;

    if (selectedCategory && catId == selectedCategory) {
      cat.classList.add("bg-primary", "text-white");
    }

    cat.addEventListener("click", () => {
      categories.forEach((c) => c.classList.remove("bg-primary", "text-white"));
      cat.classList.add("bg-primary", "text-white");
      selectedCategory = catId;
      if (categoryInput) categoryInput.value = selectedCategory;
    });
  });

  // tags selection
  const tags = document.querySelectorAll(".tag");
  const tagsInput = document.querySelector("#tags-input");
  let selectedTags = tagsInput?.value ? tagsInput.value.split(",") : [];

  tags.forEach((tag) => {
    const tagId = tag.dataset.tagId;

    if (selectedTags.includes(tagId)) {
      tag.classList.add("bg-primary", "text-white");
    }

    tag.addEventListener("click", () => {
      tag.classList.toggle("bg-primary");
      tag.classList.toggle("text-white");

      if (tag.classList.contains("bg-primary")) {
        // Add tag if selected and isn't on the selectedTags yet
        if (!selectedTags.includes(tagId)) selectedTags.push(tagId);
      } else {
        // Remove tag if unselected
        selectedTags = selectedTags.filter((id) => id !== tagId);
      }
      if (tagsInput) tagsInput.value = selectedTags.join(",");
    });
  });

  const form = document.querySelector("form");

  form?.addEventListener("submit", () => {
    const contentInput = document.querySelector("#content-input");

    if (contentInput) contentInput.value = quill.root.innerHTML;
    if (categoryInput) categoryInput.value = selectedCategory;
    if (tagsInput) tagsInput.value = selectedTags.join(",");
  });
});
