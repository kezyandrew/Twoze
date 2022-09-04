import { Component, OnInit } from '@angular/core';
import { ApiService } from 'src/app/api.service';
import { UtilService } from 'src/app/util.service';

@Component({
  selector: 'app-forgot',
  templateUrl: './forgot.page.html',
  styleUrls: ['./forgot.page.scss'],
})
export class ForgotPage implements OnInit {
  email:string = '';
  err: any;
  constructor(private api:ApiService,private util:UtilService) { }

  ngOnInit() {
  }

  public image:any = '';

  ionViewWillEnter(){
    this.util.startLoad();
    this.api.getData('settings').subscribe((success:any) => {
      if(success.success){
        this.image = success.data.imagePath + success.data.splash_screen;  
        this.util.dismissLoader();
      }
    }, err => {
      this.util.dismissLoader();
    })
  }

  verify(){
    this.util.startLoad();
    let data = {
      email:this.email
    }
    this.api.postDataWithToken('sendOtp',data).subscribe((success:any) => {
      if(success.success == true){
        this.util.navCtrl.navigateForward('otp');
        localStorage.setItem('verifyId',success.data.id);
        localStorage.setItem('isFrom','forgot');
        this.util.dismissLoader();
      }
      else{
        this.util.presentToast('Invalid User');
        this.util.dismissLoader();
      }
    }, err =>{
      this.err = err.error.errors;
      this.util.dismissLoader();
    })
  }

}
