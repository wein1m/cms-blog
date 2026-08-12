<?php
include_once "../head.php";

// Categories & Tags example
$categories = [
    ["id" => 1, "name" => "News"],
    ["id" => 2, "name" => "Interviews"],
    ["id" => 3, "name" => "Reviews"],
    ["id" => 4, "name" => "Stories"],
];

$tags = [
    ["id" => 1, "name" => "Anime"],
    ["id" => 2, "name" => "Manga"],
    ["id" => 3, "name" => "Manhwa"],
    ["id" => 4, "name" => "Manhua"],
    ["id" => 5, "name" => "Movie"],
    ["id" => 6, "name" => "TV Series"],
    ["id" => 7, "name" => "Romance"],
    ["id" => 8, "name" => "Action"],
    ["id" => 9, "name" => "Slice of Life"],
];

// Contents example
$prefill = [
    "title" => "Star Detective Precure! Anime Film Announces Three Guest Cast Members",
    "img_cover" => "https://a.storyblok.com/f/178900/960x540/be3a7827eb/detective-precure-film-guest-voice-cast.jpg/m/576x0/filters:quality(95)format(webp)",
    "content" => "
    <p>Japanese digital comic platform Piccoma today announced that an animated TV adaptation of SUOL's Villains Are Destined to Die manhwa, which adapted Gwon Gyeoeul's original web novel, is in production. It is if the adaptation is a Japanese production, and further details are yet to be revealed.</p><p><br></p><p> Press publishes the <strong>Villains Are Destined to Die</strong> manhwa in English and describes the story:</p><p><br></p><p> Daughter of the Duke's Super Love Project as the easy mode heroine, Ivonne, makes charming the male a breeze. But once you switch to hard mode and step into the shoes of Penelope, the misunderstood it's nearly impossible to even stay alive! So imagine the shock of suddenly waking up in Penelope's you know right away that your life is on the line. With love interests who will kill you if their meters drop too low and the inability to speak without choosing from pre-selected dialogue, it becomes clear that Penelope's chances have been rigged from the start—and this villain might just be to die!</p>
    "
]
?>

<link rel="stylesheet" href="../quill.css">
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />

<section class="px-86 py-32">
    <form action="create.php" method="POST" id="new-story">
        <input type="text" name="title" placeholder="Untitled Article"
            class="w-full text-5xl font-bold placeholder:text-black/30 overflow-x-visible!">
        <div class="mt-12 mb-20">
            <h5 class="text-lg font-semibold">Thumbnail</h5>
            <div class="-mt-4">
                <input type="text" id="img_url" name="img_url" placeholder="Paste image URL..."
                    class="w-full mt-3 bg-transparent border-b border-black/20 py-2">
                <div id="img-container"> </div>
            </div>
        </div>

        <!-- Quill Container -->
        <h5 class="text-lg font-semibold">Contents</h5>
        <div id="editor">
            <div id="editor-container" class="text-9xl"></div>
        </div>

        <div class="mt-10">
            <h5 class="mb-2 text-lg font-semibold">Select Category:</h5>
            <div class="flex flex-wrap gap-2">
                <?php foreach ($categories as $cat): ?>
                <button type="button" data-cat-id="<?= $cat['id'] ?>"
                    class="category text-primary font-semibold px-3 py-1 border border-primary">
                    <?= $cat["name"] ?>
                </button>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="mt-8">
            <h5 class="mb-2 text-lg font-semibold">Select Category:</h5>
            <div class="flex flex-wrap gap-2">
                <?php foreach ($tags as $tag): ?>
                <button type="button" data-tag-id="<?= $tag['id'] ?>"
                    class="tag text-primary font-semibold px-3 py-1 border border-primary">
                    # <?= $tag["name"] ?>
                </button>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="flex justify-end w-full mt-20">
            <button type="submit" class=" bg-primary text-white tracking-widest px-6 py-3 font-bold">
                Submit
            </button>
        </div>

        <!-- <input type="hidden" name="title" id="title-input">
        <input type="hidden" name="img_cover" id="img-input"> -->
        <input type="hidden" name="content" id="content-input">
        <input type="hidden" name="category" id="category-input">
        <input type="hidden" name="tags" id="tags-input">
    </form>
</section>

<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

<script>
const quill = new Quill('#editor', {
    placeholder: "Enter your stories here",
    theme: 'snow'
});

const imgInput = document.querySelector("#img_url");
const imgContainer = document.querySelector("#img-container");

let timeout;

imgInput.addEventListener("input", () => {
    clearTimeout(timeout);

    timeout = setTimeout(() => {
        const url = imgInput.value.trim();

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
    }, 500);
});

const categories = document.querySelectorAll(".category");
const tags = document.querySelectorAll(".tag");

let selectedCategory = null;
let selectedTags = [];

categories.forEach(category => {
    category.addEventListener("click", () => {
        categories.forEach(cat => {
            cat.classList.remove("bg-primary", "text-white");
        });

        category.classList.add("bg-primary", "text-white");

        selectedCategory = category.dataset.catId;
    });
});

tags.forEach(tag => {
    tag.addEventListener("click", () => {
        const tagId = tag.dataset.tagId;

        tag.classList.toggle("bg-primary");
        tag.classList.toggle("text-white");

        if (tag.classList.contains("bg-primary")) {
            // Add tag if selected
            selectedTags.push(tagId);
        } else {
            // Remove tag if unselected
            selectedTags = selectedTags.filter(id => id !== tagId);
        }
    });
});

document.querySelector("form#new-story").addEventListener("submit", () => {
    document.querySelector("#content-input").value = quill.root.innerHTML;
    document.querySelector("#category-input").value = selectedCategory;
    document.querySelector("#tags-input").value = selectedTags.join(",");
})
</script>
<?php
include_once "../foot.php";
?>
