import { Component, OnInit } from "@angular/core";
import { ModalController } from "@ionic/angular";
import { ApiService } from "src/app/api.service";
import { AddAddressPage } from "src/app/modals/add-address/add-address.page";
import { UtilService } from "src/app/util.service";

@Component({
  selector: "app-manage-address",
  templateUrl: "./manage-address.page.html",
  styleUrls: ["./manage-address.page.scss"],
})
export class ManageAddressPage implements OnInit {
  addressDiv: any = [];
  selectAddresss: any;
  isFrom: string;
  constructor(
    private modal: ModalController,
    private api: ApiService,
    private util: UtilService
  ) {}

  ngOnInit() {}

  ionViewWillEnter() {

    this.util.startLoad();
    this.isFrom = localStorage.getItem('isFrom');
    this.api.getDataWithToken("all_address").subscribe(
      (success: any) => {
        if (success.success) {
          this.addressDiv = success.data;
          this.util.dismissLoader();
        }
      },
      (err) => {}
    );

    this.selectAddresss = localStorage.getItem("SelectAddress");
  }
  async address() {
    const modal = await this.modal.create({
      component: AddAddressPage,
      cssClass: "manage-address",
    });
    modal.onDidDismiss().then((res) => {
      this.ionViewWillEnter();
      localStorage.removeItem('marketLat')
      localStorage.removeItem('marketLng')
    });
    return await modal.present();
  }

  close() {
    this.modal.dismiss();
  }

  selectAddress(item) {
    localStorage.setItem("SelectAddress", item.addr1);
    this.modal.dismiss(item);
  }

  isDelete: boolean = true;

  deleteAddress(id) {
    this.util.startLoad();
    this.api.getDataWithToken("remove_address/" + id).subscribe(
      (success: any) => {
        if (success.success == true) {
          this.isDelete = false;

          this.util.presentToast("Address Deleted Successfully");
          this.ionViewWillEnter();
          this.util.dismissLoader();
          this.isDelete = true;
        } else {
          this.util.presentToast("Address is in Use");
          this.util.dismissLoader();
        }
      },
      (err) => {
        this.util.dismissLoader();
        this.util.presentToast("Something Went Wrong");
      }
    );
  }
}
