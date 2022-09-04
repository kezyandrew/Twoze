import { Component, OnInit } from "@angular/core";
import { NavController } from "@ionic/angular";
import { ApiService } from "src/app/api.service";
import { UtilService } from "src/app/util.service";
import { countryCode } from "src/environments/environment";

@Component({
  selector: "app-signup",
  templateUrl: "./signup.page.html",
  styleUrls: ["./signup.page.scss"],
})
export class SignupPage implements OnInit {
  errr: any;
  constructor(
    private api: ApiService,
    private util: UtilService,
    private navCtrl: NavController
  ) {}
  code = "+91";
  cCode: any = countryCode;
  name: string = "";
  email: string = "";
  phone: string = "";
  password: string = "";
  confirm_password: string = "";
  ngOnInit() {}
  public btnIcon = "../../../assets/small_icon/login.svg";
  public image: any = "";
  ionViewWillEnter() {
    this.util.startLoad();
    this.api.getData("settings").subscribe(
      (success: any) => {
        if (success.success) {
          this.image = success.data.imagePath + success.data.splash_screen;

          this.util.dismissLoader();
        }
      },
      (err) => {}
    );
  }

  signUp() {
    this.util.startLoad();
    let data = {
      name: this.name,
      code: this.code,
      password: this.password,
      confirm_password: this.confirm_password,
      phone: this.phone,
      email: this.email,
    };
    this.api.postDataWithToken("register", data).subscribe(
      (success: any) => {
        if (success.success) {
          if (success.data.verify == 0) {
            localStorage.setItem("token", success.data.token);
            this.navCtrl.navigateForward("verify");
            this.util.dismissLoader();
          } else {
            localStorage.setItem("token", success.data.token);
            this.navCtrl.navigateForward("tabs/home");
            this.util.dismissLoader();
          }
        }
      },
      (err) => {
        this.errr = err.error.errors;
        this.util.dismissLoader();
      }
    );
  }
}
