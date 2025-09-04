using Kalapacsvetes;

string[] olvas = File.ReadAllLines("kalapacsvetes.txt");

List<Sportolo> sportolok = new List<Sportolo>();

foreach (string line in olvas.Skip(1))
{
    sportolok.Add(new Sportolo(line));
}

Console.WriteLine("4. feladat: {0} dobás eredménye található.", sportolok.Count);

double sum = 0;
int db = 0;

foreach (Sportolo e in sportolok)
{
    if (e.orszagkod == "HUN")
    {
        sum += e.eredmeny;
        db++;
    }
}

Console.WriteLine("5. feladat: A magyar sportolók átlagosan {0} métert dobtak.", sum / db);

Console.WriteLine("6.feladat : Adjon meg egy évszamot");

int input=int.Parse(Console.ReadLine());

int darab = 0;

foreach (Sportolo e in sportolok) 
{
    if(e datum.Substring(0,4)== input)
    {
        sum += e.eredmeny;
        db++;
    }
}