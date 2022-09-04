import { Component, OnInit } from "@angular/core";
import { ModalController, NavController } from "@ionic/angular";
import { ApiService } from "src/app/api.service";
import { UtilService } from "src/app/util.service";

@Component({
  selector: "app-login",
  templateUrl: "./login.page.html",
  styleUrls: ["./login.page.scss"],
})
export class LoginPage implements OnInit {
  email: string = "";
  password: string = "";
  err: any;
  passErr: any;
  deviceToken: any;
  constructor(
    private navCtrl: NavController,
    private api: ApiService,
    private util: UtilService,
    private modal: ModalController
  ) {}

  ngOnInit() {}
  public image: string = "";
  signup() {
    this.navCtrl.navigateForward("/signup");
    this.modal.dismiss();
  }
  ionViewWillEnter() {
    this.email = "";
    this.password = "";

    this.util.startLoad();
    this.api.getData("settings").subscribe(
      (success: any) => {
        if (success.success) {
          this.image = success.data.imagePath + success.data.splash_screen;

          this.util.dismissLoader();
        }
      },
      (err) => {
        this.util.dismissLoader();
      }
    );
  }

  goForgot() {
    this.util.navCtrl.navigateForward("forgot");
  }

  login() {
    this.util.startLoad();
    this.deviceToken = this.api.deviceToken ? this.api.deviceToken : null;
    let data = {
      device_token: this.deviceToken ? this.deviceToken : "No Token Found",
      email: this.email,
      password: this.password,
    };
    this.api.postDataWithToken("login", data).subscribe(
      (success: any) => {
        if (success.success == false) {
          this.modal.dismiss();
          this.navCtrl.navigateForward("verify");
          localStorage.setItem("token", success.data.token);
          this.util.dismissLoader();
        }
        let hasPre = localStorage.getItem("previous-request") ? true : false;
        if (hasPre) {
          let page = localStorage.getItem("previous-request-page");
          localStorage.setItem("token", success.data.token);
          this.util.setNewLogin(true);
          this.navCtrl.navigateForward(page);
          localStorage.setItem("isUserLogged", "true");
          this.util.presentToast("Login Successully");
          this.modal.dismiss();
          this.util.dismissLoader();
        } else {
          if (success) {
            this.navCtrl.navigateRoot("tabs/home");
            localStorage.setItem("token", success.data.token);
            this.util.presentToast("Login Successully");
            this.util.setNewLogin(true);
            this.util.dismissLoader();
          }
        }
      },
      (err) => {
        if (this.email == "" && this.password == "") {
          this.err = err.error.errors;
          this.passErr = err.error;
          this.util.dismissLoader();
        } else {
          this.util.presentToast("Invalid Email Or Password");
        }
      }
    );
  }
}
