// создание кнопок на странице с номером страницы по запросам
function createPageBtn(page, classes=[]) {
    let btn = document.createElement('button');
    classes.push('btn');
    for (cls of classes) {
        btn.classList.add(cls);
    }
    btn.dataset.page = page;
    btn.innerHTML = page;
    return btn;
}

// отрисовка кнопок пагинации и их редактирование под новые страницы
function renderPaginationElement(info) {
    let btn;
    let paginationContainer = document.querySelector('.pagination');
    paginationContainer.innerHTML = '';

    btn = createPageBtn(1, ['first-page-btn']);
    btn.innerHTML = 'Первая страница';
    if (info.current_page == 1) {
        btn.style.visibility = 'hidden';
    }
    paginationContainer.append(btn);

    let buttonsContainer = document.createElement('div');
    buttonsContainer.classList.add('pages-btns');
    paginationContainer.append(buttonsContainer);

    let start = Math.max(info.current_page - 2, 1);
    let end = Math.min(info.current_page + 2, info.total_pages);
    for (let i = start; i <= end; i++) {
        buttonsContainer.append(createPageBtn(i, i == info.current_page ? ['active'] : []));
    }

    btn = createPageBtn(info.total_pages, ['last-page-btn']);
    btn.innerHTML = 'Последняя страница';
    if (info.current_page == info.total_pages) {
        btn.style.visibility = 'hidden';
    }
    paginationContainer.append(btn);
}

//обработчик событий изменения количества записей на стр
function perPageBtnHandler(event) {
    downloadData(1);
}


//устанавливает информацию об интервале записей и количестве записей на стр
function setPaginationInfo(info) {
    document.querySelector('.total-count').innerHTML = info.total_count;
    let start = info.total_count > 0 ? (info.current_page - 1)*info.per_page + 1 : 0;
    document.querySelector('.current-interval-start').innerHTML = start;
    let end = Math.min(info.total_count, start + info.per_page - 1)
    document.querySelector('.current-interval-end').innerHTML = end;
}

//обработчик событий кнопок пагинации
function pageBtnHandler(event) {
    if (event.target.dataset.page) {
        downloadData(event.target.dataset.page);
        window.scrollTo(0, 0);
    }
}


//создает информацию об авторе записи
function createAuthorElement(record) {
    let user = record.user || {'name': {'first': '', 'last': ''}};
    let authorElement = document.createElement('div');
    authorElement.classList.add('author-name');
    authorElement.innerHTML = user.name.first + ' ' + user.name.last;
    return authorElement;
}


// создает элемент количество лайков записи
function createUpvotesElement(record) {
    let upvotesElement = document.createElement('div');
    upvotesElement.classList.add('upvotes');
    upvotesElement.innerHTML = record.upvotes;
    return upvotesElement;
}


//создает футтер, который вызывает инфу об авторе и количестве лайков записи
function createFooterElement(record) {
    let footerElement = document.createElement('div');
    footerElement.classList.add('item-footer');
    footerElement.append(createAuthorElement(record));
    footerElement.append(createUpvotesElement(record));
    return footerElement;
}

// создает элемент текста записи и добавляет этот текст в элемент
function createContentElement(record) {
    let contentElement = document.createElement('div');
    contentElement.classList.add('item-content');
    contentElement.innerHTML = record.text;
    return contentElement;
}

// создает запись, которая вызывает методы контента и футтера для записи
function createListItemElement(record) {
    let itemElement = document.createElement('div');
    itemElement.classList.add('facts-list-item');
    itemElement.append(createContentElement(record));
    itemElement.append(createFooterElement(record));
    return itemElement;
}

//очищение и заполнение контейнера записей
function renderRecords(records) {
    let factsList = document.querySelector('.facts-list');
    factsList.innerHTML = '';
    for (let i = 0; i < records.length; i++) {
        factsList.append(createListItemElement(records[i]));
    }
}

//асинхр запрос для получения данных о котах и выполнения поиска и последовательно заполенение данных
function downloadData(page = 1, searchTerm = '') {
    let factsList = document.querySelector('.facts-list');
    let url = new URL(factsList.dataset.url);
    let perPage = document.querySelector('.per-page-btn').value;
    
    // Добавляем параметры к запросу
    url.searchParams.append('page', page);
    url.searchParams.append('per-page', perPage);
    url.searchParams.append('q', searchTerm); // Добавляем параметр для поиска

    let xhr = new XMLHttpRequest();
    xhr.open('GET', url);
    xhr.responseType = 'json';
    xhr.onload = function () {
        renderRecords(this.response.records);       //очищение и заполнение контейнера записей
        setPaginationInfo(this.response['_pagination']);        //устанавливает информацию об интервале записей и количестве записей на стр
        renderPaginationElement(this.response['_pagination']);      // отрисовка кнопок пагинации и их редактирование под новые страницы
    }
    xhr.send();
}


//тоже делает асинх запрос но для получения данных для автозаполнения
function getAutocompleteOptions(searchTerm) {
    let autocompleteUrl = 'http://cat-facts-api.std-900.ist.mospolytech.ru/autocomplete?q=' + searchTerm;

    let xhr = new XMLHttpRequest();
    xhr.open('GET', autocompleteUrl);
    xhr.responseType = 'json';
    xhr.onload = function () {
        renderAutocompleteOptions(this.response); //вызов заполенения взятых с сервера данных для автодополнения
    };
    xhr.send();
}


//заполняет элемент datalist для автодополнения
function renderAutocompleteOptions(options) {
    let datalist = document.getElementById('autocomplete-options');

    // Очищаем предыдущие варианты
    datalist.innerHTML = '';

    // Добавляем новые варианты
    options.forEach(function (option) {
        let optionElement = document.createElement('option');
        optionElement.value = option;
        datalist.appendChild(optionElement);
    });
}


//очищает datalist когда поле запроса пустое
function clearAutocompleteOptions() {
    document.getElementById('autocomplete-options').innerHTML = '';
}


//обработчик событий загрузки страницы
window.onload = function () {
    downloadData();
    // Добавляем обработчик для кнопки поиска
    document.querySelector('.search-btn').onclick = function () {
        let searchTerm = document.querySelector('.search-field').value;
        downloadData(1, searchTerm);
    };
    document.querySelector('.pagination').onclick = pageBtnHandler;
    document.querySelector('.per-page-btn').onchange = perPageBtnHandler;
    
    //обработчик событий поля ввода для поиска
    document.querySelector('.search-field').addEventListener('input', function () {
        let searchTerm = this.value;
        if (searchTerm.length > 0) {
            getAutocompleteOptions(searchTerm); //получение вариантов автодоплнения
        } else {
            // Очищаем список автодополнения, если поле ввода пустое
            clearAutocompleteOptions();
        }
    });
}