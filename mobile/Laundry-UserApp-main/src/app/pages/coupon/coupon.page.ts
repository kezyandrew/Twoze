import { Component, OnInit } from '@angular/core';
import { ApiService } from 'src/app/api.service';
import { UtilService } from 'src/app/util.service';

@Component({
  selector: 'app-coupon',
  templateUrl: './coupon.page.html',
  styleUrls: ['./coupon.page.scss'],
})
export class CouponPage implements OnInit {
  coupons:any = [];
  code:any;
  codeCheck: any;
  discountt: any;
  coupomId: any;
  currency: string;
  constructor(private api:ApiService,private util:UtilService) { }
  
  ngOnInit() {
    this.currency = localStorage.getItem('currency_symbol');
    this.util.startLoad();
    this.api.getData('coupons').subscribe((success:any) => {
      if(success.success){
        this.coupons = success.data;
        this.util.dismissLoader();
      }
    }, err => {
      this.util.dismissLoader();
    })
  }

  checkId(item){
    localStorage.setItem('discount_type',item.type);
    this.discountt =  item.discount;
    this.codeCheck = item.code;
    this.coupomId = item.id;
  }

  checkCoupon(){
    this.util.startLoad();
    let data = {
      code:this.code
    }
    this.api.postDataWithToken('checkCoupon',data).subscribe((success:any) => {
      if(success.success == true){
        localStorage.setItem('checkCoupon',this.code);
        localStorage.setItem('discount_',this.discountt);
        this.util.navCtrl.navigateForward('tabs/home/make-payment');
        localStorage.setItem('coupon-id',this.coupomId);
        this.util.dismissLoader();
      }else{
        this.util.presentToast('This Coupon Is Expire');
        localStorage.setItem('discount_',null)
        this.util.navCtrl.navigateForward('tabs/home/make-payment');
        localStorage.removeItem('coupon-id')
      }
    }, err =>{err})
  }
  discount(arg0: string, discount: any) {
    throw new Error('Method not implemented.');
  }
}
