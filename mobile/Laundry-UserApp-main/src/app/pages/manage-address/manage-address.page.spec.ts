import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { ManageAddressPage } from './manage-address.page';

describe('ManageAddressPage', () => {
  let component: ManageAddressPage;
  let fixture: ComponentFixture<ManageAddressPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ManageAddressPage ],
      imports: [IonicModule.forRoot()]
    }).compileComponents();

    fixture = TestBed.createComponent(ManageAddressPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
