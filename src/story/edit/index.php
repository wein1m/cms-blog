<?php
require_once "../../head.php";
require_once "../../helpers/db.php";

$slug = $_GET["slug"];

if ($slug == '') {
    http_response_code(404);
    die("Story not found.");
}

$article = db_fetch_row("
    SELECT * FROM artikel WHERE slug = ?
", [$slug]);

if (!$article) {
    http_response_code(404);
    die("Story not found.");
}

$all_tags = db_fetch_all("SELECT * FROM tag");
$all_categories = db_fetch_all("SELECT * FROM kategori");

$selected_category = db_fetch_col("
    SELECT id_kategori
    FROM artikel
    WHERE id = ?
", [$article["id"]]);

$selected_tags = db_fetch_col_arr("
    SELECT tag_id
    FROM artikel_tag
    WHERE artikel_id = ?
", [$article["id"]]);

$old_slug = $slug;
?>

<link rel="stylesheet" href="/cms-blog/assets/style/quill.css">
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />

<section id="form">
    <form action="../edit.php" method="POST" id="edit-story">
        <input type="text" name="title" placeholder="Untitled Article" value="<?= $article['title'] ?>"
            class="w-full text-5xl font-bold placeholder:text-black/30 overflow-x-visible!">
        <div class="mt-12 lg:mb-20 mb-14">
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
                <button type="button" data-cat-id="<?= $cat['id'] ?>"
                    class="category pill">
                    <?= $cat["name"] ?>
                </button>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="mt-8">
            <h5 class="mb-2 text-lg font-semibold">Select Tags:</h5>
            <div class="flex flex-wrap gap-2">
                <?php foreach ($all_tags as $tag): ?>
                <button type="button" data-tag-id="<?= $tag['id'] ?>"
                    class="tag pill">
                    # <?= $tag['name'] ?>
                </button>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="flex justify-end w-full mt-14 lg:mt-20">
            <button type="submit" class="btn-primary">
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
const categoryInput = document.querySelector("#category-input");
categoryInput.value = <?= json_encode((string) $selected_category) ?>;

const tagsInput = document.querySelector("#tags-input");
tagsInput.value = <?= json_encode(array_map('strval', $selected_tags)) ?>;

const quillContent = <?= json_encode($article["content"]) ?>;
</script>
<script src="/cms-blog/assets/js/story-form.js"></script>

<?php
include_once "../../foot.php";
?>
