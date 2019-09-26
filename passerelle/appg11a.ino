#define    SIZE_ENVOI  17
#define   SIZE_RECEP  15

#define IR 26
#define MICRO 5
#define TEMPERATURE 25
#define VENTILATEUR 11
int temp;
float mesure_IR;
int mesure_micro;
float SEUIL_MICRO=1000;
float SEUIL_TEMPERATURE = 33.0;
float SEUIL_IR = 3.0;

int tempOffset=230;
int micOffset=1328;

int clap=0;
int microActive=0;
int vent=0;
String c;  
int securiteActive=0;
int alerte=0;


char  Conv_hexToAsc(char digH); // d�finition de la fonction de ...
                  // conversion d'un chiffre hexa en code ASCII
void  Envoi_Trame(int valcapt, int typeCapt); // d�finition de la fonction d'envoi ...
                        // d'une trame
void  Recep_Trame(void);      // d�finition de la fonction de r�ception d'une trame
void  Wait_CleSonore(void);   // fonction qui attend la cl� sonore

char  TrameEnvoi[20];   // buffer pour envoyer  une trame vers la passerelle
char  TrameRecep[20];   // buffer pour recevoir une trame venant de la passerelle
char  CheckSum;

void setup()
{
  // put your setup code here, to run once:
  Serial.begin(9600);
  Serial1.begin(9600);

  
/*
 *Serial1.write("AT+NAMEe-Labify");
 *delay(500);
 *Serial1.write("AT+PIN1234"); // paramètrage du module bluetooth
 *delay(500);
 */

  // ajouter ici les autres initialisations
  //  -- code du setup() pour la cl� sonore
  pinMode(IR, INPUT);
  pinMode(MICRO, INPUT);
  pinMode(TEMPERATURE, INPUT);
  pinMode(VENTILATEUR, OUTPUT);
  analogWrite(VENTILATEUR, 0);

  
  pinMode(2, OUTPUT);
  pinMode(34, OUTPUT);
  pinMode(35, OUTPUT);
  pinMode(36, OUTPUT);
  pinMode(37, OUTPUT);

  pinMode(30, OUTPUT);
  pinMode(40, OUTPUT);
//  digitalWrite(30, HIGH);
  
  // Partie constante de la trame 
  TrameEnvoi[0] = '1';  // le champ TRA. choisir toujours "Trame courante = 1"
              // le champ OBJ (4 octets) = numero de groupe. ex 007A 007B ...
  TrameEnvoi[1] = '0';  // mettre le chiffre du numero de groupe (0)
  TrameEnvoi[2] = '1';  // mettre le chiffre du numero de groupe (1)
  TrameEnvoi[3] = '1';  // mettre le chiffre du numero de groupe (1)
  TrameEnvoi[4] = 'A';  // mettre la lettre  du numero de groupe (A, B, ... E)
  TrameEnvoi[5] = '1';  // champ REQ. 1= Requete en ecriture / mettre =2 pour requete en lecture et 3 pour lect/ecriture
//  TrameEnvoi[6] = ;   // champ TYP. remplir dans la boucle (voir Doc)
//  TrameEnvoi[7] = '0';  // champ NUM (2 octets). Numero du capteur
//  TrameEnvoi[8] = '2';  // On choisit par exemple le numero 02.
//  TrameEnvoi[ 9] = ;    // Champ VAL (4 octets) = valeur � envoyer au site web
//  TrameEnvoi[10] = ;    // par exemple la valeur du capteur de lumiere
//  TrameEnvoi[11] = ;
//  TrameEnvoi[12] = ;
  TrameEnvoi[13] = 'B'; // Champ TIM (4 octets) = heure d'envoi de la trame
  TrameEnvoi[14] = 'A'; // Ce champ n'est pas utilis� par la passerelle; donc
  TrameEnvoi[15] = 'B'; // on peut mettre la valeur qu'on veut
  TrameEnvoi[16] = 'A';
//  TrameEnvoi[17] = ;    // premier  chiffre (poid fort)   du checksum
//  TrameEnvoi[18] = ;    // deuxieme chiffre (poid faible) du checksum
}

void loop()
{
  
  
  
    Envoi_Trame_Lecture(0x02,0x3A); // LUMIERE
    Envoi_Trame_Lecture(0x03,0x3C); // VENTILATEUR
    Envoi_Trame_Lecture(0x04,0x31); // ACTIVATION SECURITE
    temp = ((analogRead(TEMPERATURE)*5*1000)/4095)-tempOffset;
    Envoi_Trame_Ecriture(0x01, intToHex(temp), 0x33); // température, capteur type 3 numero 1  
    
    int delayInterractions=millis();
    while(millis()<(delayInterractions+5000)){ // delais de 5 secondes
      
      mesure_micro = mesureMicro();
      Serial.println(mesure_micro);
      if(microActive && mesure_micro>SEUIL_MICRO){
        clap=detectionClap(clap);
        //Envoi_Trame_Ecriture(0x02, intToHex(clap), 0x3A); // capteur de detection sonore
      }

      if(securiteActive && alerte==0){
        mesure_IR = analogRead(IR)*20.475/4095.0;
        //Serial.println(mesure_IR);
        if(mesure_IR>SEUIL_IR){
          alerte=1;
          Envoi_Trame_Ecriture(0x05, intToHex(1), 0x37); // capteur de presence, capteur type 7
          digitalWrite(40, LOW);
          digitalWrite(30, HIGH);
        }
      }
      else if(securiteActive==0){
        digitalWrite(30, LOW);
        if(securiteActive){
          digitalWrite(40, HIGH);
        }
      }
    }
  
}


void Envoi_Trame_Ecriture(int numCapt, int valCapt, int typeCapt){

  TrameEnvoi[5] = '1';  // champ REQ. 1= Requete en ecriture / mettre =2 pour requete en lecture et 3 pour lect/ecriture
  Envoi_Trame(numCapt, valCapt, typeCapt);
  
}



int Envoi_Trame_Lecture(int numCapt, int typeCapt){

  TrameEnvoi[5] = '2';  // champ REQ. 1= Requete en ecriture / mettre =2 pour requete en lecture et 3 pour lect/ecriture
  Envoi_Trame(numCapt, 2, typeCapt);

}



int mesureMicro(){
  int res=analogRead(MICRO)-micOffset;
  res*=res;
  return res;
}



int detectionClap(int clap){
    
    boolean estCourt=false;
    double tmpMillis = millis();
    while (millis()<tmpMillis+10 && estCourt==false){
      int mesure=mesureMicro();
      //Serial.println(mesure);
      if (mesure<SEUIL_MICRO){
        estCourt=true;
      }
      
      //Serial.println(estCourt);
      
    }
    if (estCourt){
      
      if (clap==0){
        digitalWrite(35, HIGH);
        digitalWrite(36, HIGH);
        digitalWrite(37, HIGH);
        clap=1;
      }
      else if (clap==1){
        digitalWrite(35, LOW);
        digitalWrite(36, LOW);
        digitalWrite(37, LOW);
        clap=0;
      }
    }
  return clap;
  delay(50);
}



int intToHex(int nb) {
  char tc[6]="0x";
  if (nb<100){
    strcat(tc,"0");
    if (nb<10) {
      strcat(tc,"0");
      if (nb<1) {
        strcat(tc,"0");
      }
    }
  }
  sprintf(tc, "%s%d", tc, nb);
  return strtoul(tc,0,16);
}




//---------------------------------
void  Envoi_Trame(int numCapt, int valcapt, int typeCapt)
//---------------------------------
{ int n;  char digH, digA;  // digit (4 bits) Hexa et Ascii

  digitalWrite(2, HIGH);
  //Ecriture du numéro de capteur dans la trame
  digH = (numCapt >> 4) & 0x0F;  // poid fort du CheckSum
  digA = Conv_hexToAsc(digH);
  TrameEnvoi[7] = digA;  // champ NUM (2 octets) ici 1er octet. Numero du capteur
  
  digH = numCapt & 0x0F;     // poid faible du CheckSum
  digA = Conv_hexToAsc(digH);
  TrameEnvoi[8] = digA;  // champ NUM (2 octets) ici 2eme octet. Numero du capteur
  
  TrameEnvoi[6] = typeCapt; // type capteur
  // convertir la valeur du capteur en 4 chiffres ASCII (poid fort en premier)
  // conversion du 1er chiffre (poid fort)
  digH = (valcapt >> 12) & 0x0F;  // >> signifie d�calage de 12 bits vers la droite
  digA = Conv_hexToAsc(digH);
  TrameEnvoi[9] = digA;
  // conversion du 2e chiffre
  digH = (valcapt >> 8) & 0x0F; // d�calage de 8 bits vers la droite
  digA = Conv_hexToAsc(digH);
  TrameEnvoi[10] = digA;
  // conversion du 3e chiffre
  digH = (valcapt >> 4) & 0x0F; // d�calage de 4 bits vers la droite
  digA = Conv_hexToAsc(digH);
  TrameEnvoi[11] = digA;
  // conversion du 4e chiffre (poid faible)
  digH = valcapt & 0x0F;    // pas besoin de d�calage. garder juste le dernier digit
  digA = Conv_hexToAsc(digH);
  TrameEnvoi[12] = digA;

  Serial.print("Trame = ");
  // boucle pour envoyer une trame vers la passerelle
  CheckSum = 0;
  // envoi des 'SIZE_ENVOI' premiers octets
  for (n = 0; n < SIZE_ENVOI; n++) {
    Serial.print(TrameEnvoi[n]);
    Serial1.print(TrameEnvoi[n]);
    CheckSum = CheckSum + TrameEnvoi[n];
  }
  digH = (CheckSum >> 4) & 0x0F;  // poid fort du CheckSum
  digA = Conv_hexToAsc(digH);
  Serial.print(digA);       // envoi du poid fort
  Serial1.print(digA);
  digH = CheckSum & 0x0F;     // poid faible du CheckSum
  digA = Conv_hexToAsc(digH);
  Serial.print(digA);       // envoi du poid faible
  Serial1.print(digA);
  Serial.println();       // retour � la ligne

  Recep_Trame();
  digitalWrite(2, LOW);

}

//---------------------------------
char  Conv_hexToAsc(char digH)
//---------------------------------
{ char valAsc;

  digH &= 0x0F;   // garder que les 4 bits de poid faible = 1 chiffre hexa (0 � 15)
  valAsc = digH + 0x30;
  if (digH > 9)
    valAsc += 0x07;
  return valAsc;
}

void  Recep_Trame(void)
//---------------------------------
//---------------------------------
{
  // boucle d'attente de  "SIZE_RECEP" octets dans le buffer TrameRecep[]
  // avant chaque lecture d'un octet, v�rifier que le port de r�ception 
  // contient un octet en attente.

  delay(50);

  int watchdog=millis();
  while(Serial1.available()<15 && millis()<Serial1.available()+100){
  }
  
  Serial1.readString().toCharArray(TrameRecep,SIZE_RECEP);
  
  for(int i=0; i<SIZE_RECEP; i++){
    Serial.print(TrameRecep[i]);
  }
  Serial.println();
  
  /*  
  // TRA
  TrameRecep[0]; 
  
  // OBJ
  TrameRecep[1];
  TrameRecep[2];
  TrameRecep[3];
  TrameRecep[4];
  
  // REQ
  TrameRecep[5];
  
  // TYP
  TrameRecep[6];
  
  // NUM
  TrameRecep[7];
  TrameRecep[8];
  
  // ANS
  TrameRecep[9];
  TrameRecep[10];
  TrameRecep[11];
  TrameRecep[12];
  
  // CHK
  TrameRecep[13];
  TrameRecep[14];
  */
  
  if(TrameRecep[5]=='1' && TrameEnvoi[5] == '2'){
    switch (TrameRecep[6]){    
      case ':':
        switch (TrameRecep[12]){
          case '0':
            microActive=0;
            digitalWrite(34, LOW);

          break;
          
          case '1':
            microActive=1;
            digitalWrite(34, HIGH);
          break;
        }
      break;
      
      case '<':
        switch (TrameRecep[12]){
          case '0':
            analogWrite(VENTILATEUR, 0);
            vent=0;
          break;

          case '1':
            analogWrite(VENTILATEUR, 255);
            vent=1;
          break;
        }
      break;

      case '1':
        switch (TrameRecep[12]){
          case '0':
            securiteActive=0;
            alerte=0;
            digitalWrite(40, LOW);
          break;
        
          case '1':
            securiteActive=1;
            digitalWrite(30, LOW);
            digitalWrite(40, HIGH);
          break;
        }
      break;
    }
  }
}


void  Wait_CleSonore(void)
//---------------------------------
//---------------------------------
{
  // Copier ici le code de test de la cl� sonore
}
