import weka.classifiers.Classifier;
import weka.classifiers.Evaluation;
import weka.classifiers.bayes.NaiveBayes;
import weka.core.Attribute;
import weka.core.FastVector;
import weka.core.Instance;
import weka.core.Instances;
import weka.experiment.InstanceQuery;


/* WekaWrapper
 * Wraps requests to weka
 * 
 */
public class WekaWrapper {
		
	
	/* Post()
	 * Update Database w/ classifiers.
	 */
	public void Post(){
		
	}
	
	/* Output
	 * Outputs data in weka like format.
	 */
	public void Output(Evaluation eTest ){
        String strSummary = eTest.toSummaryString();
        System.out.println(strSummary);
         
        // Get the confusion matrix
        double[][] cmMatrix = eTest.confusionMatrix();
        for(int row_i=0; row_i<cmMatrix.length; row_i++){
            for(int col_i=0; col_i<cmMatrix.length; col_i++){
                System.out.print(cmMatrix[row_i][col_i]);
                System.out.print("|");
            }
            System.out.println();	
        }
    }
}
