import { Component, OnInit } from '@angular/core';
import { ModalController } from '@ionic/angular';
import { CalendarComponentOptions, CalendarModalOptions } from 'ion2-calendar';
import { ApiService } from 'src/app/api.service';

@Component({
  selector: 'app-calendar',
  templateUrl: './calendar.page.html',
  styleUrls: ['./calendar.page.scss'],
})
export class CalendarPage implements OnInit {
  dateToBook: any;

  constructor(private api:ApiService,private modal:ModalController) { 
    
  }
  date: string;
  type: 'string';
  ngOnInit() {
  }
  onSelect($event) {
  }
  onChange($event) {
    this.dateToBook =  $event.format('DD-MM-YYYY');
    this.api.date = this.dateToBook
  }

 

  optionsRange: CalendarComponentOptions = {
    monthPickerFormat:['JAN']
  }

}
