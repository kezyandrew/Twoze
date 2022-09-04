import { Component, OnInit } from "@angular/core";
import { NavController } from "@ionic/angular";
import { ApiService } from "src/app/api.service";
import { UtilService } from "src/app/util.service";

@Component({
  selector: "app-otp",
  templateUrl: "./otp.page.html",
  styleUrls: ["./otp.page.scss"],
})
export class OtpPage implements OnInit {
  otp = "";
  err: any;
  constructor(
    public api: ApiService,
    private navCtrl: NavController,
    private util: UtilService
  ) {}
  public image: any = "";
  ngOnInit() {}
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

  otpVerify() {
    this.util.startLoad();
    if (localStorage.getItem("isFrom") == "verify") {
      let data = {
        otp: this.otp,
        user_id: localStorage.getItem("verifyId"),
      };
      this.api.postDataWithToken("checkOtp", data).subscribe(
        (success: any) => {
          if (success.success == true) {
            this.navCtrl.navigateForward("tabs/home");
            localStorage.setItem("token", success.data.token);
            this.util.dismissLoader();
          } else {
            this.util.presentToast("Invalid OTP");
            this.util.dismissLoader();
          }
        },
        (err) => {
          this.err = err.error.errors;
          this.util.dismissLoader();
          
        }
      );
    } else {
      let data = {
        otp: this.otp,
        user_id: localStorage.getItem("verifyId"),
      };
      this.api.postDataWithToken("checkOtp", data).subscribe(
        (success: any) => {
          if (success.success == true) {
            this.navCtrl.navigateForward("newpassword");
            this.util.dismissLoader();
          } else {
            this.util.presentToast("Invalid OTP");
          }
        },
        (err) => {
          this.err = err.error.errors;
          
          this.util.dismissLoader();
        }
      );
    }
  }
}
