#include "stdafx.h"
#include <iostream>
#include <string>
#define _USE_MATH_DEFINES
#include <math.h>

using namespace std;

class Punkt
{
	float x, y;
	string nazwa;

public:
	Punkt(string n = "S", float a = 0, float b = 0)
	{
		nazwa = n;
		x = a;
		y = b;
	}

	void wyswietl()
	{
		cout << nazwa << "(" << x << "," << y << ")" << endl;
	}
};

class Kolo :public Punkt //klasa Kolo dziedziczy publicznie z klasy Punkt
{
protected:
	float r;
	string nazwa;

public:
	void wyswietl()
	{
		cout << "Kolo o nazwie: " << nazwa << endl;
		cout << "Srodek kola: " << endl;
		Punkt::wyswietl();
		cout << "Promien: " << r << endl;
		cout << "Pole kola : " << M_PI*r*r << endl;
	}

	Kolo(string nk = "Kolko", string np = "S", float a = 0, float b = 0, float pr = 2)
		:Punkt(np, a, b)
	{
		nazwa = nk;
		r = pr;
	}
};

class Kula :protected Kolo
{
public:
	Kula()
	:Kolo()
	{
	}

	void wyswietl()
	{
		Kolo::wyswietl();

		cout << "Objetosc kuli: " << 4 * M_PI * r * r * r/3;
	}
};
int main()
{
	Kula k1;
	k1.wyswietl();

	system("pause");
	return 0;
}


