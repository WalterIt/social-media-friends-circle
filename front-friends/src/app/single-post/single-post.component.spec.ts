import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { SinglePostComponent } from './single-post.component';
import { MatIconModule,  MatCardModule } from '@angular/material';
import { HttpClientModule } from '@angular/common/http';
import { RouterTestingModule } from '@angular/router/testing';
import { UserService } from '../shared/services/user.service';
import { NetworkService } from '../shared/services/network.service';
import { AuthService } from '../shared/services/auth.service';
import { SocketsService } from '../shared/services/sockets.service';
import { Post } from '../shared/entities/Posts';

describe('SinglePostComponent', () => {
  let component: SinglePostComponent;
  let fixture: ComponentFixture<SinglePostComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SinglePostComponent ],
      providers: [
        UserService,
        NetworkService,
        AuthService,
        SocketsService
       ],
      imports: [
        MatIconModule,
        MatCardModule,
        HttpClientModule,
        RouterTestingModule
      ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SinglePostComponent);
    component = fixture.componentInstance;

    component.post = new Post({
      id: 1,
      content: 'This post content.'
    });

    fixture.detectChanges();
  });

  fit('should create', () => {
    expect(component).toBeTruthy();
  });
});
