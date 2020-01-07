class Basket {
    constructor() {
    	this.items = this.loadBasket();
   		console.log(this.items);
   		this.displayItemsBasket();
    }

    loadBasket() {

		let items = loadDataFromDomStorage('basketBeer4you');

		if (items == null) {
			items = [];
		}

		return items;
	}

    displayItemsBasket() {
        if(this.items.length > 0) {
  			$('#itemBasket').removeClass('hide');
   			$('#itemBasket').text(this.items.length);
   		} else {
   			$('#itemBasket').addClass('hide');
   			$('#itemBasket').text('');
   		}
    }

    addToBasket(beerId, name, quantity, price) {
        beerId    = parseInt(beerId);
    	quantity  = parseInt(quantity);

    	let item = {
			beerId: beerId,
			name: name,
			quantity: quantity,
			price: price
		}

		for(let index = 0; index < this.items.length; index++)
		{
		    if(this.items[index].beerId == beerId)
		    {
		      	this.items[index].quantity += quantity

		            this.saveBasket();

		            return true;
		    }
		}

		this.items.push(item);
		this.saveBasket();
    }


    displayCompleteBasket() {
        let totalPrice= 0;
        if(this.items.length > 0) {
            $('#displayBasket table tbody').empty();
            for (let i = 0; i < this.items.length; i++) {
				totalPrice += parseFloat(this.items[i].quantity)*parseFloat(this.items[i].price);
				var tr = $('<tr>');
				tr.append('<td>'+this.items[i].quantity+'</td><td>'+this.items[i].name+'</td><td>'+this.items[i].price.toFixed(2)+' €</td><td>'+(parseFloat(this.items[i].quantity)*parseFloat(this.items[i].price)).toFixed(2) +' €</td><td><button class="trash-beer" data-index="'+i+'"><i class="fas fa-trash-alt"></i></button></td>')
				$('#displayBasket table tbody').append(tr);
			}

        } else {
            $('#displayBasket').html('<p>Votre panier est vide...</p>');
			$('.p-form').css('display', 'none');
        }

        $('#totalPrice').text(totalPrice.toFixed(2));
    }

    removeToBasket(id) {
		this.items.splice(id, 1);
		this.saveBasket();
	}

    saveBasket() {
		saveDataToDomStorage('basketBeer4you', this.items);
		this.displayItemsBasket();
		if(window.location.href.indexOf('/basket') != -1) {
			this.displayCompleteBasket();
		}
    }

    loadBasketInInput(elmt) {
		$(elmt).val(JSON.stringify(this.items));
	}
  
}
