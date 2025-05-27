<div class="filters_container" id="admin-filters">
    <aside class="filters">
        <form method="get" style="display: flex; flex-direction: column; gap: 10px;">
            <div class="search">
                <input type="search" name="search" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
                    placeholder="Поиск" aria-label="Поиск">
                <button type="submit" class="transparent" aria-label="Найти" id="search-button">
                    <img src="/assets/imgs/icons/search.svg" alt="search">
                </button>
            </div>
            <button class="white" id="add__open" type="button">Добавить товар</button>
            <p class="title">Фильтры</p>
            <div class="filters__content">
                <a href="?sort=id_asc<?= isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : '' ?>">По
                    возрастанию ID</a>
                <a href="?sort=id_desc<?= isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : '' ?>">По
                    убыванию ID</a>
            </div>
        </form>
    </aside>
</div>