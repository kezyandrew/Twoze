import { Component, OnInit } from '@angular/core';
import { NavController, Platform } from '@ionic/angular';

@Component({
  selector: 'app-payment-done',
  templateUrl: './payment-done.page.html',
  styleUrls: ['./payment-done.page.scss'],
})
export class PaymentDonePage implements OnInit {

  constructor(private platform:Platform,private navCtrl:NavController) { 
    this.platform.backButton.subscribe( () => {
      this.navCtrl.navigateRoot('tabs/home')
    })
  }
  goOrders(){
    this.navCtrl.navigateRoot('tabs/orders');
  }

  ngOnInit() {
  }

}
