import { Injectable } from '@angular/core';
import { LoadingController, NavController, ToastController } from '@ionic/angular';
import { BehaviorSubject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class UtilService {
  isLoading: boolean;

  constructor(private toastController:ToastController,public navCtrl:NavController,private loadingController:LoadingController) { }

  async presentToast(msg) {
    const toast = await this.toastController.create({
      message: msg,
      duration: 3000,
      mode:'ios',
      cssClass:"my-toast",
    });
    toast.present();
  }

  async startLoad() {
    this.isLoading = true;
    return await this.loadingController
    .create({
      duration: 5000,
      cssClass: "custom-loader",
      message: `<div class="sk-chase">
      <div class="sk-chase-dot"></div>
      <div class="sk-chase-dot"></div>
      <div class="sk-chase-dot"></div>
      <div class="sk-chase-dot"></div>
      <div class="sk-chase-dot"></div>
      <div class="sk-chase-dot"></div>
    </div>`,
    spinner: null,
  })
      .then((a) => {
        a.present().then(() => {
          if (!this.isLoading) {
            a.dismiss().then(() => {});
          }
        });
      });
    }
    async dismissLoader() {
      this.isLoading = false;
      return await this.loadingController.dismiss();
    }
    
  newLogin: BehaviorSubject<boolean> = new BehaviorSubject<boolean>(false);
  setNewLogin(val) {
    this.newLogin.next(val);
  }

  isNewLogin() {
    return this.newLogin.asObservable();
  }

  editProfile: BehaviorSubject<boolean> = new BehaviorSubject<boolean>(false);

  setNewprofile(val){
    this.editProfile.next(val);
  }

  isnewProfile(){
    return this.editProfile.asObservable();
  }
}
