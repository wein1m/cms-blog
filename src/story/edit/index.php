<?php
include_once "../../head.php";

$slug = $_GET["slug"];

if ($slug == '') {
    http_response_code(404);
    echo "Story not found.";
}

$query = "SELECT * FROM artikel WHERE slug = ?";
$stmt = $conn->prepare($query);
$stmt->execute([$slug]);
$article = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$article) {
    http_response_code(404);
    echo "Story not found.";
}

$tags_query = "SELECT * FROM tag";
$stmt = $conn->query($tags_query);
$all_tags = $stmt->fetchAll(PDO::FETCH_ASSOC);

$kategori_query = "SELECT * FROM kategori";
$stmt = $conn->query($kategori_query);
$all_categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

$category_query = "
    SELECT kategori.id
    FROM artikel
    JOIN kategori
        ON artikel.id_kategori = kategori.id
    WHERE artikel.id = ?;
";
$stmt = $conn->prepare($category_query);
$stmt->execute([$article["id"]]);
$selected_category = $stmt->fetchColumn();

$tags_query = "
    SELECT tag.id
    FROM artikel_tag
    JOIN tag
        ON artikel_tag.tag_id = tag.id
    WHERE artikel_tag.artikel_id = ?
";

$stmt = $conn->prepare($tags_query);
$stmt->execute([$article["id"]]);
$selected_tags = $stmt->fetchAll(PDO::FETCH_COLUMN);

$old_slug = $slug;
?>

<link rel="stylesheet" href="../../quill.css">
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />

<section class="px-86 py-32">
    <form action="../edit.php" method="POST" id="edit-story">
        <input type="text" name="title" placeholder="Untitled Article" value="<?= $article['title'] ?>"
            class="w-full text-5xl font-bold placeholder:text-black/30 overflow-x-visible!">
        <div class="mt-12 mb-20">
            <h5 class="text-lg font-semibold">Thumbnail</h5>
            <div class="-mt-4">
                <input type="text" id="img_url" name="img_url" placeholder="Paste image URL..."
                    class="w-full mt-3 bg-transparent border-b border-black/20 py-2"
                    value="<?= $article['img_cover'] ?>">
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
                <?php foreach ($all_categories as $cat): ?>
                <?php if ($cat["id"] == $selected_category): ?>
                <button type="button" data-cat-id="<?= $cat['id'] ?>"
                    class="category text-primary font-semibold px-3 py-1 border border-primary text-white bg-primary">
                    <?= $cat["name"] ?>
                </button>
                <?php else: ?>
                <button type="button" data-cat-id="<?= $cat['id'] ?>"
                    class="category text-primary font-semibold px-3 py-1 border border-primary">
                    <?= $cat["name"] ?>
                </button>
                <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="mt-8">
            <h5 class="mb-2 text-lg font-semibold">Select Tags:</h5>
            <div class="flex flex-wrap gap-2">
                <?php
                foreach ($all_tags as $tag):
                $is_selected = in_array($tag["id"], $selected_tags);
                 ?>
                <button type="button" data-tag-id="<?= $tag['id'] ?>"
                    class="tag text-primary font-semibold px-3 py-1 border border-primary <?= $is_selected ? 'text-white bg-primary' : '' ?>">
                    # <?= $tag['name'] ?>
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
        <input type="hidden" name="old_slug" id="oldSlug-input" value="<?= $old_slug ?>">
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

const addImg = (url) => {
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
}

window.addEventListener("load", () => {
    addImg("<?= $article["img_cover"] ?>");
})

imgInput.addEventListener("input", () => {
    clearTimeout(timeout);

    addImg(imgInput.value.trim());

    timeout = setTimeout(() => {}, 500);
});

const categories = document.querySelectorAll(".category");
const tags = document.querySelectorAll(".tag");

let selectedCategory = <?= json_encode((string) $selected_category) ?>;
let selectedTags = <?= json_encode(array_map('strval', $selected_tags)) ?>;

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

quill.root.innerHTML = `<?= $article['content'] ?>`;

document.querySelector("form#edit-story").addEventListener("submit", () => {
    document.querySelector("#content-input").value = quill.root.innerHTML;
    document.querySelector("#category-input").value = selectedCategory;
    document.querySelector("#tags-input").value = selectedTags.join(",");
})
</script>
<?php
include_once "../../foot.php";
?>
