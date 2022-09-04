import { Component, OnInit } from "@angular/core";
import { ModalController, NavController, Platform } from "@ionic/angular";
import { ApiService } from "src/app/api.service";
import { UtilService } from "src/app/util.service";
import { CancelOrderPage } from "../cancel-order/cancel-order.page";

@Component({
  selector: "app-orders",
  templateUrl: "./orders.page.html",
  styleUrls: ["./orders.page.scss"],
})
export class OrdersPage implements OnInit {
  orders: any = [];
  token: string = "";
  constructor(
    private navCtrl: NavController,
    private util: UtilService,
    private api: ApiService,
    private modal: ModalController,
    private platform: Platform
  ) {
    this.platform.backButton.subscribe(() => {
      this.navCtrl.navigateRoot("tabs/home");
    });
  }

  ngOnInit() {}
  products: any = [];
  ionViewWillEnter() {
    this.util.startLoad();
    this.token = localStorage.getItem("token");
    this.api.getDataWithToken("allOrders").subscribe(
      (success: any) => {
        if (success.success) {
          this.orders = success.data.current;

          this.pastOrders = success.data.past;

          this.util.dismissLoader();
        }
      },
      (err) => {
        this.util.dismissLoader();
      }
    );
  }

  doRefresh(event) {
    setTimeout(() => {
      this.ionViewWillEnter();
      event.target.complete();
    }, 500);
  }

  async cancelOrder(id) {
    const modal = await this.modal.create({
      component: CancelOrderPage,
      cssClass: "cancel",
      componentProps: {
        id: id,
      },
    });
    modal.onDidDismiss().then((res) => {
      this.ionViewWillEnter();
    });
    return await modal.present();
  }

  check(id) {
    localStorage.setItem("order-id", id);
    this.navCtrl.navigateForward("tabs/orders/billing-detail");
  }

  pastOrders: any = [];
  see() {
    this.navCtrl.navigateForward("tabs/orders/billing-detail");
  }
}
