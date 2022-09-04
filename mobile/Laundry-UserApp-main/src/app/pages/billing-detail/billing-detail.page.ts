import { Component, OnInit } from '@angular/core';
import { ModalController, NavController } from '@ionic/angular';
import { ApiService } from 'src/app/api.service';
import { UtilService } from 'src/app/util.service';
import { CancelOrderPage } from '../cancel-order/cancel-order.page';

@Component({
  selector: 'app-billing-detail',
  templateUrl: './billing-detail.page.html',
  styleUrls: ['./billing-detail.page.scss'],
})
export class BillingDetailPage implements OnInit {
  id: any;
  data:any ={};
  currency: string;
  constructor(private modal:ModalController,private api:ApiService,private util:UtilService) { }

  ngOnInit() {
    this.currency = localStorage.getItem('currency_symbol')
  }
  ionViewWillEnter(){
    this.util.startLoad();
    this.id = localStorage.getItem('order-id');
    this.api.getDataWithToken('singleOrder/' + this.id).subscribe((success:any) => {
      if(success.success){
        this.data = success.data;
        this.util.dismissLoader();
      }
    }, err => {
      this.util.dismissLoader();
    })
  }

 

}
