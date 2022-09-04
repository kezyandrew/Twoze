import { Component, Input, OnInit } from '@angular/core';
import { ModalController } from '@ionic/angular';
import { ApiService } from 'src/app/api.service';
import { UtilService } from 'src/app/util.service';

@Component({
  selector: 'app-cancel-order',
  templateUrl: './cancel-order.page.html',
  styleUrls: ['./cancel-order.page.scss'],
})
export class CancelOrderPage implements OnInit {

  constructor(private modal:ModalController,private api:ApiService,private util:UtilService) { }
  @Input() id:any;
  
  ngOnInit() {
  }

  dismis(){
    this.modal.dismiss();
  }

  remove(){
    this.util.startLoad();
    this.api.getDataWithToken('cancelOrder/' + this.id).subscribe((success:any) => {
      if(success.success){
        this.modal.dismiss();
        this.util.presentToast('Order Canceled Successfully');
        this.util.dismissLoader();
      }
    }, err => {
      this.util.dismissLoader();
      this.modal.dismiss();
      this.util.presentToast('Something Went Wrong');
    })
  } 

}
