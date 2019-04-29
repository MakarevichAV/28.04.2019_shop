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

    }
    renderCatalog() {

        // 1. Создаем пустой объект
        let xhr = new XMLHttpRequest;

        // 2. Наполняем его данными для отправки
        xhr.open('GET', '/handlers/catalogHandler.php');

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
            // console.log(data);
        });

        // let catalogItems = [
        //     {
        //         name : 'Куртка синяя',
        //         pic : '1.jpg',
        //         price : '5 200'
        //     },
        //     {
        //         name : 'Куртка оранжевая',
        //         pic : '2.jpg',
        //         price : '3 200'
        //     }
        // ];

        // data.forEach( function (value, index) {
        //     let newCard = new Product(value.name, value.pic, value.price);
        //     newCard.createCard();
        // } );
    }
}

let catalog = new Catalog();
catalog.renderCatalog();

// let newCard = new Product('Куртка синяя', '1.jpg', '5 200');
// newCard.createCard();

// newCard = new Product('Куртка оранжевая', '2.jpg', '3 200');
// newCard.createCard();