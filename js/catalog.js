class Product {
    // Данные
    constructor (productName, productPic, productPrice) {
        this.name = productName;
        this.pic = productPic;
        this.price = productPrice;
        this.el = document.querySelector('.goods');
    }
    // Действия с данными  // Методы
        createCard() {
        let card = document.createElement('div');
        card.classList.add('product');
        card.innerHTML = `
            <div class="product-img" style="background-image: url(/images/catalog/${this.pic})"></div>
            <p class="product-name">${this.name}</p>
            <p class="price"><span>${this.price}</span> руб.</p>
        `;
        this.el.appendChild(card);
    }
}

class Catalog {
    constructor () {
        this.el = document.querySelector('.goods');
    }
    cleanCatalog() {
        this.el.innerHTML = '';
    }
    renderCatalog(subCatId) {

        this.cleanCatalog();

        // 1. Создаем пустой объект
        let xhr = new XMLHttpRequest;

        // проверка есть ли GET параметры в строке
        // тернарный оператор (вместо if else) 
        let catID = (window.location.search == '') ? '?id=1' : window.location.search ;


        if (subCatId != undefined) {
            catID = `?id=${subCatId}`;
        }

        // 2. Наполняем его данными для отправки
        xhr.open('GET', `/handlers/catalogHandler.php${catID}`);

        // 3. Отправляем данные
        xhr.send();

        // 4. Ждем ответ от сервера
        xhr.addEventListener('load', function () {
        
            let data = JSON.parse(xhr.responseText);

            // выводим карточки товаров на основании полученныч данных
            data.forEach( function (value, index) {
                let newCard = new Product(value.name, value.pic, value.price);
                newCard.createCard();
            } );
    
        });

    }
}

let catalog = new Catalog();
catalog.renderCatalog();


let catalogSelect = document.querySelectorAll('.subcat');

console.log(catalogSelect);
catalogSelect.forEach( function (v, i) {
    v.addEventListener('change', function () {
        // alert('подкатегория выбрана');
        
        // получаем значение выбранного инпута radio
        let selectValue = v.value;
        
        // создаем новый экземпляр объекта Catalog 
        let catalog = new Catalog();
        catalog.renderCatalog( selectValue );

    });
} );