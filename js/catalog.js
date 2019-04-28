class Product {
    //данные
    constructor (productName, productPic, productPrice) {
        this.name = productName;
        this.pic = productPic;
        this.price = productPrice;
        this.el = document.querySelector('.goods');

    }
    // что мы делаем с этими данными
    createCard () {
    //1.создаем блок
        let productCardBlock = document.createElement ('div');
       

    //2.добавляем стили
        productCardBlock.classList.add ('goods-item');

    //3.вставляем HTML код в блок 
        productCardBlock.innerHTML = `
        <div class="foto-item" style ="background-image: url(/images/catalog/${this.pic})"></div>
        <div class="goods-name">${this.name}</div>
        <div class="goods-price">${this.price}</div>`;

    //4.добавляем уврточку товара в блок
        this.el.appendChild(productCardBlock);

    }
}


class Catalog {
    constructor () {

    }
    renderCatalog () {
        //1. создаем пустой объект
        let xhr = new XMLHttpRequest; 

        //2. наполняем данными для отправки
        xhr.open('GET', '/handlers/catalogHandler.php');

        //3. отправляем данные 
        xhr.send();

        //4. ждем ответ от сервера
        xhr.addEventListener('load', function() { 
            //преобразовываем данные в формат json для js 
            let data = JSON.parse( xhr.responseText );
                
        data.forEach(function( value, index ) {
            let newProduct = new Product(value.name, value.pic, value.price);
            newProduct.createCard();
            
        });

        console.log( data );
        
        });
        
        // let catalogItems = [
        //     {
        //         name : "Куртка синяя",
        //         pic : '1.jpg',
        //         price : '5400'
    
        //     },

        //     {
        //         name : "Куртка с капюшоном",
        //         pic : '2.jpg',
        //         price : '6100'
    
        //     }

        // ];
        







       // console.log(catalogItems);
    }
}

let catalog = new Catalog();
catalog.renderCatalog();


//let newProduct = new Product ('Куртка бежевая', '1.jpg', '7 500');
//newProduct.createCard();


//newProduct = new Product ('Куртка красная', '2.jpg', '5 500');
//newProduct.createCard();